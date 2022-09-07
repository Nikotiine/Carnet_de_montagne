<?php

namespace App\Entity;

use App\Repository\NotebookPageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
#[UniqueEntity("title")]
#[ORM\Entity(repositoryClass: NotebookPageRepository::class)]
#[Vich\Uploadable]
class NotebookPage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    #[Assert\NotBlank]
    private ?string $title = null;

    #[ORM\Column(length: 150)]
    #[Assert\NotNull]
    #[Assert\NotBlank]
    private ?string $routName = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[Assert\NotBlank]
    private ?\DateTimeImmutable $achieveAt = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotNull]
    #[Assert\NotBlank]
    private ?string $story = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive]
    private ?int $heightDifference = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $totalTime = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $pointToReview = null;

    #[ORM\ManyToOne(inversedBy: "notebookPages")]
    #[ORM\JoinColumn(nullable: false)]
    private ?Difficulty $difficulty = null;

    #[ORM\ManyToOne]
    private ?ConditionMeteo $conditionMeteot = null;

    #[ORM\ManyToOne(inversedBy: "notebookPages")]
    #[ORM\JoinColumn(nullable: false)]
    private ?MountainLocation $moutainLocation = null;

    #[ORM\ManyToOne]
    private ?Felling $feeling = null;

    #[ORM\ManyToOne(inversedBy: "notebookPages")]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $author = null;

    #[ORM\Column]
    private ?bool $isPublic = null;

    #[ORM\ManyToOne(inversedBy: "notebookPages")]
    #[ORM\JoinColumn(nullable: false)]
    private ?MainCategory $category = null;
    // NOTE: This is not a mapped field of entity metadata, just a simple property.
    #[
        Vich\UploadableField(
            mapping: "notebook_image",
            fileNameProperty: "imageName"
        )
    ]
    private ?File $imageFile = null;

    #[ORM\Column(type: "string", nullable: true)]
    private ?string $imageName = null;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getRoutName(): ?string
    {
        return $this->routName;
    }

    public function setRoutName(string $routName): self
    {
        $this->routName = $routName;

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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getAchieveAt(): ?\DateTimeImmutable
    {
        return $this->achieveAt;
    }

    public function setAchieveAt(\DateTimeImmutable $achieveAt): self
    {
        $this->achieveAt = $achieveAt;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getHeightDifference(): ?int
    {
        return $this->heightDifference;
    }

    public function setHeightDifference(?int $heightDifference): self
    {
        $this->heightDifference = $heightDifference;

        return $this;
    }

    public function getTotalTime(): ?\DateTimeInterface
    {
        return $this->totalTime;
    }

    public function setTotalTime(?\DateTimeInterface $totalTime): self
    {
        $this->totalTime = $totalTime;

        return $this;
    }

    public function getPointToReview(): ?string
    {
        return $this->pointToReview;
    }

    public function setPointToReview(?string $pointToReview): self
    {
        $this->pointToReview = $pointToReview;

        return $this;
    }

    public function getDifficulty(): ?Difficulty
    {
        return $this->difficulty;
    }

    public function setDifficulty(?Difficulty $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getConditionMeteot(): ?ConditionMeteo
    {
        return $this->conditionMeteot;
    }

    public function setConditionMeteot(?ConditionMeteo $conditionMeteot): self
    {
        $this->conditionMeteot = $conditionMeteot;

        return $this;
    }

    public function getMoutainLocation(): ?MountainLocation
    {
        return $this->moutainLocation;
    }

    public function setMoutainLocation(?MountainLocation $moutainLocation): self
    {
        $this->moutainLocation = $moutainLocation;

        return $this;
    }

    public function getFeeling(): ?Felling
    {
        return $this->feeling;
    }

    public function setFeeling(?Felling $feeling): self
    {
        $this->feeling = $feeling;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function isIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): self
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function getCategory(): ?MainCategory
    {
        return $this->category;
    }

    public function setCategory(?MainCategory $category): self
    {
        $this->category = $category;

        return $this;
    }
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }
}
