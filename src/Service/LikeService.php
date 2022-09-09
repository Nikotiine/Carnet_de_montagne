<?php

namespace App\Service;

use App\Repository\LikeRepository;

use App\Repository\NotebookPageRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class LikeService
{
    public function __construct(
        private NotebookPageRepository $notebookPageRepository,
        private LikeRepository $likeRepository
    ) {
    }

    public function getTotalPagesLiked(UserInterface $user): array
    {
        $userPages = $this->notebookPageRepository->findBy([
            "author" => $user,
        ]);

        return $this->likeRepository->findBy([
            "notebookPage" => $userPages,
        ]);
    }
    public function getMylikes(UserInterface $user): array
    {
        return $this->likeRepository->countMyLike($user);
    }
}
