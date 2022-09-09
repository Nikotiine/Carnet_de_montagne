<?php

namespace App\Controller;

use App\Repository\HomeDisplayedMessageRepository;
use App\Repository\MainCategoryRepository;
use App\Repository\NotebookPageRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route("/", name: "app_home", methods: ["GET", "POST"])]
    public function index(
        NotebookPageRepository $repository,
        MainCategoryRepository $categoryRepository,
        UserRepository $userRepository,
        HomeDisplayedMessageRepository $displayedMessageRepository,
        Request $request,
        PaginatorInterface $paginator
    ): Response {
        $currentPagePaginated = $request->query->getInt("page", 1);
        $nbItemsPerViews = $request->query->getInt("nbPage", 10);
        $selectedCategory = $request->query->getInt("cat", 0);
        $orderBy = $request->query->getAlpha("orderBy", "DESC");
        $selectedUser = $request->query->getInt("byUser", 0);
        $notebook = $paginator->paginate(
            $repository->findByPublicNote($orderBy),
            $currentPagePaginated,
            $nbItemsPerViews
        );
        if (0 !== $selectedCategory) {
            $notebook = $paginator->paginate(
                $repository->findPublicWithParameters(
                    $selectedCategory,
                    $orderBy
                ),
                $currentPagePaginated,
                $nbItemsPerViews
            );
        }
        if (0 !== $selectedUser && 0 !== $selectedCategory) {
            $notebook = $paginator->paginate(
                $repository->findPublicUserNotebookWithCategory(
                    $selectedUser,
                    $selectedCategory,
                    $orderBy
                ),
                $currentPagePaginated,
                $nbItemsPerViews
            );
        }
        if (0 !== $selectedUser && 0 == $selectedCategory) {
            $notebook = $paginator->paginate(
                $repository->findPublicUserNotebooks($selectedUser, $orderBy),
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
            "selectNbItemsPerView" => [10, 20, 40, 100],
            "selectedOrderBy" => $orderBy,
            "users" => $userRepository->findAllFirstAndLastName(),
            "selectedUser" => $selectedUser,
            "messages" => $displayedMessageRepository->findAll(),
        ]);
    }
}
