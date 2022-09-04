<?php

namespace App\Controller;

use App\Repository\MainCategoryRepository;
use App\Repository\NotebookPageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route("/dashboard", name: "app_dashboard")]
    #[IsGranted("ROLE_USER")]
    public function dashboard(
        NotebookPageRepository $repository,
        MainCategoryRepository $categoryRepository,
        Request $request,
        PaginatorInterface $paginator
    ): Response {
        $category = $categoryRepository->findAll();
        $profil = $this->getUser();
        dump($profil);
        $notebook = $paginator->paginate(
            $repository->findBy([
                "author" => $this->getUser(),
                "category" => 1,
            ]),
            $request->query->getInt("page", 1),
            2
        );

        return $this->render("dashboard/dashboard.html.twig", [
            "categories" => $category,
            "userProfil" => $profil,
            "fullAccess" => true,
        ]);
    }
}
