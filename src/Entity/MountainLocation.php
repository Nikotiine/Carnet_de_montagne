<?php

namespace App\Entity;

use App\Repository\MountainLocationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MountainLocationRepository::class)]
class MountainLocation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[
        ORM\OneToMany(
            mappedBy: "moutainLocation",
            targetEntity: NotebookPage::class
        )
    ]
    private Collection $notebookPages;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

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
            $notebookPage->setMoutainLocation($this);
        }

        return $this;
    }

    public function removeNotebookPage(NotebookPage $notebookPage): self
    {
        if ($this->notebookPages->removeElement($notebookPage)) {
            // set the owning side to null (unless already changed)
            if ($notebookPage->getMoutainLocation() === $this) {
                $notebookPage->setMoutainLocation(null);
            }
        }

        return $this;
    }
}
