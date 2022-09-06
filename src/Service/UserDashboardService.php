<?php

namespace App\Service;

use App\Entity\MainCategory;
use App\Entity\User;
use App\Repository\MainCategoryRepository;
use App\Repository\NotebookPageRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class UserDashboardService
{
    public function __construct(
        private NotebookPageRepository $notebookPageRepository,
        private MainCategoryRepository $categoryRepository
    ) {
    }
    public function getAllCategories(): array
    {
        return $this->categoryRepository->findAll();
    }

    public function getCategoriesLabels(array $categories): array
    {
        $labels = [];
        foreach ($categories as $category) {
            $labels[] = $category->getName();
        }
        return $labels;
    }
    public function getCategoriesColors(array $categories): array
    {
        $colors = [];
        foreach ($categories as $category) {
            $colors[] = $category->getColor();
        }
        return $colors;
    }
    public function getStatForCategory(
        array $categories,
        UserInterface $user
    ): array {
        $data = [];
        $stats = $this->notebookPageRepository->getStats($user);
        foreach ($categories as $category) {
            $data[] = $this->attributeStat($category->getId(), $stats);
        }
        return $data;
    }
    public function getSuggestedMax(UserInterface $user): int
    {
        return $this->notebookPageRepository->getTotalPagesInNotebooks($user);
    }

    private function attributeStat(int $id, array $stats)
    {
        $nb = 0;
        foreach ($stats as $stat) {
            if ($stat["id"] === $id) {
                $nb = $stat["data"];
            }
        }
        return $nb;
    }
}
