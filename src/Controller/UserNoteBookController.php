<?php

namespace App\Controller;

use App\Entity\MainCategory;
use App\Entity\NotebookPage;
use App\Repository\NotebookPageRepository;
use Doctrine\ORM\NonUniqueResultException;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserNoteBookController extends AbstractController
{
    #[IsGranted("ROLE_USER")]
    #[Route("/user/notebook/{id}", name: "app_user_note_book")]
    public function showByCategory(
        MainCategory $category,
        NotebookPageRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $user = $this->getUser();
        $notebook = $paginator->paginate(
            $repository->findBy([
                "author" => $user,
                "category" => $category,
            ]),
            $request->query->getInt("page", 1),
            2
        );
        $lastpage = $repository->findLastEntry();
        return $this->render("user_note_book/paginated_notebook.html.twig", [
            "notebook" => $notebook,
            "category" => $category,
            "lastEntry" => $lastpage ? $lastpage[0]->getCreatedAt() : "",
            "edit" => true,
        ]);
    }
    #[IsGranted("ROLE_USER")]
    #[
        Route(
            "/user/notebook-all",
            name: "app_user_notebook_all",
            methods: ["GET"]
        )
    ]
    public function showAllNoteBooks(
        NotebookPageRepository $repository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $user = $this->getUser();
        $notebooks = $paginator->paginate(
            $repository->findBy([
                "author" => $user,
            ]),
            $request->query->getInt("page", 1),
            2
        );

        return $this->render(
            "user_note_book/paginated_all_notebooks.html.twig",
            [
                "notebooks" => $notebooks,
                "edit" => true,
            ]
        );
    }
}
