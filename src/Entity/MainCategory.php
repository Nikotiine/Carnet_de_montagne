<?php

namespace App\Entity;

use App\Repository\MainCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MainCategoryRepository::class)]
class MainCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: NotebookPage::class, orphanRemoval: true)]
    private Collection $notebookPages;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $color = null;

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
            $notebookPage->setCategory($this);
        }

        return $this;
    }

    public function removeNotebookPage(NotebookPage $notebookPage): self
    {
        if ($this->notebookPages->removeElement($notebookPage)) {
            // set the owning side to null (unless already changed)
            if ($notebookPage->getCategory() === $this) {
                $notebookPage->setCategory(null);
            }
        }

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
