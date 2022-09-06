<?php

namespace App\Controller;

use App\Repository\MainCategoryRepository;

use App\Repository\NotebookPageRepository;
use App\Service\ChartsService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route("/dashboard", name: "app_dashboard")]
    #[IsGranted("ROLE_USER")]
    public function dashboard(
        MainCategoryRepository $categoryRepository,
        NotebookPageRepository $notebookPageRepository,
        ChartsService $chartsService
    ): Response {
        $profil = $this->getUser();
        $categories = $categoryRepository->findAll();
        $categoriesLabel = [];
        $data = [];
        $colors = [];
        $title = "Statistique personelles";
        $suggestedMax = $profil->getNotebookPages()->count();
        foreach ($categories as $category) {
            $categoriesLabel[] = $category->getName();
            $colors[] = $category->getColor();
            $data[] = $notebookPageRepository->count([
                "author" => $profil,
                "category" => $category,
            ]);
        }
        $chart = $chartsService->doughnutChart(
            $title,
            $categoriesLabel,
            $data,
            $colors,
            $suggestedMax
        );

        return $this->render("dashboard/dashboard.html.twig", [
            "categories" => $categories,
            "userProfil" => $profil,
            "fullAccess" => true,
            "chart" => $chart,
            "colors" => $colors,
        ]);
    }
}
