<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AuthController extends AbstractController
{
    #[Route("/auth", name: "app_auth", methods: ["GET", "POST"])]
    public function login(AuthenticationUtils $authenticationUtils): Response {
        return $this->render("auth/auth.html.twig", [
            "last_username" => $authenticationUtils->getLastUsername(),
            "error" => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    #[Route("/register", name: "app_register", methods: ["GET", "POST"])]
    public function registration(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $user = new User();
        $user->setRoles(["ROLE_USER"]);
        $form = $this->createForm(RegistrationFormType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $manager->persist($user);
            $manager->flush();
            $this->addFlash(
                "success",
                "Vous etes bien enregistré , vous pouvez vous connecter"
            );
            return $this->redirectToRoute("app_auth");
        }
        return $this->render("auth/register.html.twig", [
            "form" => $form->createView(),
        ]);
    }
    #[Route("/logout", name: "app_logout", methods: ["GET"])]
    public function logout()
    {
        // controller can be blank: it will never be called!
        throw new \Exception(
            'Don\'t forget to activate logout in security.yaml'
        );
    }
}
