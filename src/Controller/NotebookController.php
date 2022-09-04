<?php

namespace App\Controller;

use App\Entity\MainCategory;
use App\Entity\MountainLocation;
use App\Entity\NotebookPage;
use App\Entity\User;
use App\Form\MoutainLocationType;
use App\Form\NotebookPageType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotebookController extends AbstractController
{
    /**
     * Creation d'une nouvelle note dans le carnet
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route("/notebook/new/{id}", name: "app_notebook_new")]
    #[IsGranted("ROLE_USER")]
    public function newPage(
        Request $request,
        EntityManagerInterface $manager,
        MainCategory $category
    ): Response {
        $page = new NotebookPage();
        $page->setCategory($category);
        $form = $this->createForm(NotebookPageType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $page = $form->getData();
            $page->setAuthor($this->getUser());
            $manager->persist($page);
            $manager->flush();
            $this->addFlash("success", "Nouvelle note ajoutée");
            return $this->redirectToRoute("app_user_note_book", [
                "id" => $page->getCategory()->getId(),
            ]);
        }
        return $this->render("notebook/new_page.html.twig", [
            "form" => $form->createView(),
            "title" => "Creation",
        ]);
    }

    /**
     * Permet d'ajouter une nouvelle localisation de massif montagneux
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[
        Route(
            "/notebook/moutain-location",
            name: "app_notebook_new_mountain_location"
        )
    ]
    #[IsGranted("ROLE_USER")]
    public function newMountainLocation(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $moutainLocation = new MountainLocation();
        $form = $this->createForm(MoutainLocationType::class, $moutainLocation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $moutainLocation = $form->getData();
            $manager->persist($moutainLocation);
            $manager->flush();
            $this->addFlash("success", "Nouveau massif disponible");

            return $this->redirectToRoute("app_notebook_new");
        }

        return $this->render("notebook/new_moutain_loc.html.twig", [
            "form" => $form->createView(),
        ]);
    }
    /**
     * Modification de la note par l'utilisateur proprietaire
     */
    #[
        Route(
            "/notebook/note/edit/{id}",
            name: "app_notebook_edit_page",
            methods: ["GET", "POST"]
        )
    ]
    #[Security("is_granted('ROLE_USER') and user === page.getAuthor()")]
    public function edit(
        NotebookPage $page,
        EntityManagerInterface $manager,
        Request $request
    ): Response {
        $form = $this->createForm(NotebookPageType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $page->setUpdatedAt(new \DateTimeImmutable());
            $page = $form->getData();
            $manager->persist($page);
            $manager->flush();
            $this->addFlash("success", "Note modifiée");
            return $this->redirectToRoute("app_dashboard");
        }

        return $this->render("notebook/new_page.html.twig", [
            "form" => $form->createView(),
            "title" => "Edition",
        ]);
    }
    #[
        Route(
            "/notebook/note/delete/{id}",
            name: "app_notebook_delete_page",
            methods: ["GET"]
        )
    ]
    #[Security("is_granted('ROLE_USER') and user === page.getAuthor()")]
    public function delete(
        NotebookPage $page,
        EntityManagerInterface $manager
    ): Response {
        $manager->remove($page);
        $manager->flush();
        $this->addFlash("success", "Sortie effacée");
        return $this->redirectToRoute("app_user_note_book", [
            "id" => $page->getCategory()->getId(),
        ]);
    }
}
