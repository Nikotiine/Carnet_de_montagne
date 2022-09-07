<?php

namespace App\Controller\Admin;

use App\Entity\ConditionMeteo;
use App\Entity\Difficulty;
use App\Entity\Felling;
use App\Entity\HomeDisplayedMessage;
use App\Entity\MainCategory;
use App\Entity\MountainLocation;
use App\Entity\NotebookPage;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractDashboardController
{
    #[Route("/admin", name: "admin")]
    #[IsGranted("ROLE_ADMIN")]
    public function index(): Response
    {
        return $this->render("admin/admin_dashbord.html.twig");
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("Carnet De Montagne")
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard("Dashboard", "fa fa-home");
        yield MenuItem::linkToCrud(
            "Utilisateurs",
            "fa-solid fa-users",
            User::class
        );
        yield MenuItem::linkToCrud(
            "Massif montagneux",
            "fa-solid fa-mountain",
            MountainLocation::class
        );
        yield MenuItem::linkToCrud(
            "Type de sorties",
            "fa-solid fa-route",
            MainCategory::class
        );
        yield MenuItem::linkToCrud(
            "Conditions meteo",
            "fa-solid fa-cloud-sun",
            ConditionMeteo::class
        );
        yield MenuItem::linkToCrud(
            "Sentiments",
            "fa-solid fa-cloud-sun",
            Felling::class
        );
        yield MenuItem::linkToCrud(
            "Difficultes",
            "fa-solid fa-cloud-sun",
            Difficulty::class
        );
        yield MenuItem::linkToCrud(
            "Sortie utilisateurs",
            "fa-solid fa-person-hiking",
            NotebookPage::class
        );
        yield MenuItem::linkToCrud(
            "Message d'acceuil",
            "fa-solid fa-person-hiking",
            HomeDisplayedMessage::class
        );
    }
}
