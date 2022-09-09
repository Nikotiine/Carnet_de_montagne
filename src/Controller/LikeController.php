<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\LikeService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LikeController extends AbstractController
{
    #[Route("/dashboard/like", name: "app_user_like")]
    public function detail(LikeService $likeService): Response {
        $myLike = $likeService->getMylikes($this->getUser());
        $likedNote = $likeService->getTotalPagesLiked($this->getUser());

        return $this->render("user/like/detail.html.twig", [
            "mylike" => $myLike[0][1],
            "like" => $likedNote,
        ]);
    }
}
