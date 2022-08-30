<?php

namespace App\Controller;

use App\Entity\NotebookPage;
use App\Form\NotebookPageType;
use App\Repository\MainCategoryRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route("/dashboard", name: "app_dashboard")]
    #[IsGranted("ROLE_USER")]
    public function dashboard(Request $request): Response {
        $page = new NotebookPage();
        $form = $this->createForm(NotebookPageType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $page = $form->getData();
            dump($page);
        }
        return $this->render("dashboard/dashboard.html.twig", [
            "form" => $form->createView(),
        ]);
    }
}
