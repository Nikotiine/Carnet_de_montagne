<?php

namespace App\Controller;

use App\Repository\NotebookPageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(
        NotebookPageRepository $repository,
        Request $request,
        PaginatorInterface $paginator
    ): Response {
        $notebook = $paginator->paginate(
            $repository->findByLastPublicNote(),
            $request->query->getInt('page', 1),
            2
        );

        return $this->render('home/index.html.twig', [
            'notebook' => $notebook,
        ]);
    }
}
