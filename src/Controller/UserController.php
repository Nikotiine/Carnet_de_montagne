<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserSettings;
use App\Form\UserPasswordType;
use App\Form\UserSettingsType;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route("/user/edit/{id}", name: "app_user_edit", methods: ["GET", "POST"])]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function edit(
        User $currentUser,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $form = $this->createForm(UserType::class, $currentUser);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $currentUser->setUpdatedAt(new \DateTimeImmutable());
            $currentUser = $form->getData();
            $manager->persist($currentUser);
            $manager->flush();
            $this->addFlash("success", "Profil correctement modifié");

            return $this->redirectToRoute("app_dashboard");
        }

        return $this->render("user/edit.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    #[
        Route(
            "/user/change-password/{id}",
            name: "app_user_edit_password",
            methods: ["GET", "POST"]
        )
    ]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function editPassword(
        User $currentUser,
        Request $request,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $manager
    ): Response {
        $form = $this->createForm(UserPasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (
                $hasher->isPasswordValid(
                    $currentUser,
                    $form->getData()["plainPassword"]
                )
            ) {
                $currentUser->setUpdatedAt(new \DateTimeImmutable());
                $currentUser->setPlainPassword($form->getData()["newPassword"]);
                $manager->persist($currentUser);
                $manager->flush();
                $this->addFlash("success", "Mot de passe modifié");

                return $this->redirectToRoute("app_dashboard");
            }
        }

        return $this->render("user/edit_password.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    #[Route("/user/show/{id}", name: "app_user_show", methods: ["GET"])]
    public function showUserProfil(User $user): Response {
        return $this->render("user/show_profil.html.twig", [
            "userProfil" => $user,
            "fullAccess" => false,
        ]);
    }

    #[
        Route(
            "/user/settings/{id}",
            name: "app_user_settings",
            methods: ["GET", "POST"]
        )
    ]
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    public function settings(
        User $currentUser,
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $settings = new UserSettings();
        if ($currentUser->getSetting() !== null) {
            $settings = $currentUser->getSetting();
        }
        $form = $this->createForm(UserSettingsType::class, $settings);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $settings = $form->getData();
            $settings->setUser($currentUser);
            $manager->persist($settings);
            $manager->flush();
            $this->addFlash("success", "setting modifié");

            return $this->redirectToRoute("app_dashboard");
        }

        return $this->render("user/setting.html.twig", [
            "form" => $form->createView(),
        ]);
    }
}
