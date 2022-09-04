<?php

namespace App\Controller;

use App\Repository\MainCategoryRepository;
use App\Repository\NotebookPageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route("/", name: "app_home", methods: ["GET"])]
    public function index(
        NotebookPageRepository $repository,
        MainCategoryRepository $categoryRepository,
        Request $request,
        PaginatorInterface $paginator
    ): Response {
        $currentPagePaginated = $request->query->getInt("page", 1);
        $nbItemsPerViews = $request->query->getInt("nbPage", 5);
        $selectedCategory = $request->query->getInt("cat", 0);
        $orderBy = $request->query->getAlpha("orderBy", "DESC");
        $notebook = $paginator->paginate(
            $repository->findByPublicNote($orderBy),
            $currentPagePaginated,
            $nbItemsPerViews
        );
        if ($selectedCategory !== 0) {
            $notebook = $paginator->paginate(
                $repository->findPublicWithParameters(
                    $selectedCategory,
                    $orderBy
                ),
                $currentPagePaginated,
                $nbItemsPerViews
            );
        }

        return $this->render("home/index.html.twig", [
            "notebook" => $notebook,
            "edit" => false,
            "nbPage" => $notebook->getItemNumberPerPage(),
            "categories" => $categoryRepository->findAll(),
            "selectedCategory" => $selectedCategory,
            "selectNbItemsPerView" => [5, 10, 25, 50],
            "selectedOrderBy" => $orderBy,
        ]);
    }
}
