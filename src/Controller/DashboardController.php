<?php

namespace App\Controller;

use App\Service\ChartsService;
use App\Service\UserDashboardService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route("/dashboard", name: "app_dashboard")]
    #[IsGranted("ROLE_USER")]
    public function dashboard(
        ChartsService $chartsService,
        UserDashboardService $dashboardService
    ): Response {
        $profil = $this->getUser();
        $settings = $profil->getSetting();
        $likes = $dashboardService->getTotalPagesLiked($profil);
        dump($likes);
        $categories = $dashboardService->getAllCategories();
        $colors = $dashboardService->getCategoriesColors($categories);
        if ($settings !== null) {
            $colors = $dashboardService->getSettingsColors($settings);
        }
        $title = "Statistique personelles";
        $categoriesLabel = $dashboardService->getCategoriesLabels($categories);
        $data = $dashboardService->getStatForCategory($categories, $profil);
        $suggestedMax = $dashboardService->getSuggestedMax($profil);
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
            "likes" => $likes,
        ]);
    }
}
