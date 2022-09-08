<?php

namespace App\Controller;

use App\Entity\Like;
use App\Entity\MainCategory;
use App\Entity\MountainLocation;
use App\Entity\NotebookPage;
use App\Form\LikeType;
use App\Form\MoutainLocationType;
use App\Form\NotebookPageType;
use App\Repository\LikeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use function Symfony\Component\Translation\t;

class NotebookController extends AbstractController
{
    /**
     * Creation d'une nouvelle note dans le carnet.
     */
    #[Route("/notebook/new/{id}", name: "app_notebook_new")]
    #[IsGranted("ROLE_USER")]
    public function newPage(
        Request $request,
        EntityManagerInterface $manager,
        MainCategory $category
    ): Response {
        $page = new NotebookPage();
        $page->setCategory($category);
        $form = $this->createForm(NotebookPageType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $page = $form->getData();
            $page->setAuthor($this->getUser());
            $manager->persist($page);
            $manager->flush();
            $this->addFlash("success", "Nouvelle note ajoutée");

            return $this->redirectToRoute("app_user_note_book", [
                "id" => $page->getCategory()->getId(),
            ]);
        }

        return $this->render("notebook/new_page.html.twig", [
            "form" => $form->createView(),
            "title" => "Creation",
        ]);
    }

    /**
     * Permet d'ajouter une nouvelle localisation de massif montagneux.
     */
    #[
        Route(
            "/notebook/moutain-location",
            name: "app_notebook_new_mountain_location"
        )
    ]
    #[IsGranted("ROLE_USER")]
    public function newMountainLocation(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $moutainLocation = new MountainLocation();
        $form = $this->createForm(MoutainLocationType::class, $moutainLocation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $moutainLocation = $form->getData();
            $manager->persist($moutainLocation);
            $manager->flush();
            $this->addFlash("success", "Nouveau massif disponible");

            return $this->redirectToRoute("app_notebook_new");
        }

        return $this->render("notebook/new_moutain_loc.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    /**
     * Modification de la note par l'utilisateur proprietaire.
     */
    #[
        Route(
            "/notebook/note/edit/{id}",
            name: "app_notebook_edit_page",
            methods: ["GET", "POST"]
        )
    ]
    #[Security("is_granted('ROLE_USER') and user === page.getAuthor()")]
    public function edit(
        NotebookPage $page,
        EntityManagerInterface $manager,
        Request $request
    ): Response {
        $form = $this->createForm(NotebookPageType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $page->setUpdatedAt(new \DateTimeImmutable());
            $page = $form->getData();
            $manager->persist($page);
            $manager->flush();
            $this->addFlash("success", "Note modifiée");

            return $this->redirectToRoute("app_dashboard");
        }

        return $this->render("notebook/new_page.html.twig", [
            "form" => $form->createView(),
            "title" => "Edition",
        ]);
    }

    #[
        Route(
            "/notebook/note/delete/{id}",
            name: "app_notebook_delete_page",
            methods: ["GET"]
        )
    ]
    #[Security("is_granted('ROLE_USER') and user === page.getAuthor()")]
    public function delete(
        NotebookPage $page,
        EntityManagerInterface $manager
    ): Response {
        $manager->remove($page);
        $manager->flush();
        $this->addFlash("success", "Sortie effacée");

        return $this->redirectToRoute("app_user_note_book", [
            "id" => $page->getCategory()->getId(),
        ]);
    }
    #[IsGranted("ROLE_USER")]
    #[
        Route(
            "/notebook/detail/note/{id}",
            name: "app_notebook_detail_page",
            methods: ["GET", "POST"]
        )
    ]
    public function detail(
        NotebookPage $page,
        Request $request,
        EntityManagerInterface $manager,
        LikeRepository $repository
    ): Response {
        $liked = $repository->findOneBy([
            "notebookPage" => $page,
            "user" => $this->getUser(),
        ]);
        dump($liked);
        $like = new Like();
        if ($liked) {
            $like = $liked;
        }
        $form = $this->createForm(LikeType::class, $like);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $like->setNotebookPage($page);
            $like->setUser($this->getUser());
            $like = $form->getData();
            dump($like);
            $manager->persist($like);
            $manager->flush();
        }

        return $this->render("notebook/one_page.html.twig", [
            "page" => $page,
            "edit" => false,
            "form" => $form->createView(),
        ]);
    }
}
