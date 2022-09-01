<?php

namespace App\Controller;

use App\Entity\MountainLocation;
use App\Entity\NotebookPage;
use App\Form\MoutainLocationType;
use App\Form\NotebookPageType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NotebookController extends AbstractController
{
    #[Route("/notebook/new", name: "app_notebook_new")]
    #[IsGranted("ROLE_USER")]
    public function newPage(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $page = new NotebookPage();
        $form = $this->createForm(NotebookPageType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $page = $form->getData();
            $page->setAuthor($this->getUser());
            $manager->persist($page);
            $manager->flush();
            $this->addFlash("success", "Nouvelle note ajoutée");
            return $this->redirectToRoute("app_dashboard");
        }

        return $this->render("notebook/new_page.html.twig", [
            "form" => $form->createView(),
        ]);
    }
    #[
        Route(
            "/notebook/new/moutain-location",
            name: "app_notebook_new_mountain_location"
        )
    ]
    #[IsGranted("ROLE_USER")]
    public function newMountainLocation(): Response
    {
        $moutainLocation = new MountainLocation();
        $form = $this->createForm(MoutainLocationType::class, $moutainLocation);
        return $this->render("notebook/new_moutain_loc.html.twig", [
            "form" => $form->createView(),
        ]);
    }
}
