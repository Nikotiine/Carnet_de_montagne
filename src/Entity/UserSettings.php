<?php

namespace App\Entity;

use App\Repository\UserSettingsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserSettingsRepository::class)]
class UserSettings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $colorCatGrandeVoie = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $colorCatGrandeVoieTrad = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $colorCatAlpiRocheux = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $colorCatAlpiMixte = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $colorCatRando = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $colorCatRandoAlpine = null;

    #[ORM\OneToMany(mappedBy: 'userSettings', targetEntity: User::class)]
    private Collection $user;

    public function __construct()
    {
        $this->user = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColorCatGrandeVoie(): ?string
    {
        return $this->colorCatGrandeVoie;
    }

    public function setColorCatGrandeVoie(?string $colorCatGrandeVoie): self
    {
        $this->colorCatGrandeVoie = $colorCatGrandeVoie;

        return $this;
    }

    public function getColorCatGrandeVoieTrad(): ?string
    {
        return $this->colorCatGrandeVoieTrad;
    }

    public function setColorCatGrandeVoieTrad(?string $colorCatGrandeVoieTrad): self
    {
        $this->colorCatGrandeVoieTrad = $colorCatGrandeVoieTrad;

        return $this;
    }

    public function getColorCatAlpiRocheux(): ?string
    {
        return $this->colorCatAlpiRocheux;
    }

    public function setColorCatAlpiRocheux(?string $colorCatAlpiRocheux): self
    {
        $this->colorCatAlpiRocheux = $colorCatAlpiRocheux;

        return $this;
    }

    public function getColorCatAlpiMixte(): ?string
    {
        return $this->colorCatAlpiMixte;
    }

    public function setColorCatAlpiMixte(?string $colorCatAlpiMixte): self
    {
        $this->colorCatAlpiMixte = $colorCatAlpiMixte;

        return $this;
    }

    public function getColorCatRando(): ?string
    {
        return $this->colorCatRando;
    }

    public function setColorCatRando(?string $colorCatRando): self
    {
        $this->colorCatRando = $colorCatRando;

        return $this;
    }

    public function getColorCatRandoAlpine(): ?string
    {
        return $this->colorCatRandoAlpine;
    }

    public function setColorCatRandoAlpine(?string $colorCatRandoAlpine): self
    {
        $this->colorCatRandoAlpine = $colorCatRandoAlpine;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUser(): Collection
    {
        return $this->user;
    }

    public function addUser(User $user): self
    {
        if (!$this->user->contains($user)) {
            $this->user->add($user);
            $user->setUserSettings($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->user->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getUserSettings() === $this) {
                $user->setUserSettings(null);
            }
        }

        return $this;
    }
}
