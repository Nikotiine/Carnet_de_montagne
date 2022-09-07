<?php

namespace App\Entity;

use App\Repository\DifficultyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: DifficultyRepository::class)]
#[UniqueEntity("name")]
class Difficulty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: "difficulty", targetEntity: NotebookPage::class)]
    private Collection $notebookPages;

    public function __construct()
    {
        $this->notebookPages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, NotebookPage>
     */
    public function getNotebookPages(): Collection
    {
        return $this->notebookPages;
    }

    public function addNotebookPage(NotebookPage $notebookPage): self
    {
        if (!$this->notebookPages->contains($notebookPage)) {
            $this->notebookPages->add($notebookPage);
            $notebookPage->setDifficulty($this);
        }

        return $this;
    }

    public function removeNotebookPage(NotebookPage $notebookPage): self
    {
        if ($this->notebookPages->removeElement($notebookPage)) {
            // set the owning side to null (unless already changed)
            if ($notebookPage->getDifficulty() === $this) {
                $notebookPage->setDifficulty(null);
            }
        }

        return $this;
    }
}
