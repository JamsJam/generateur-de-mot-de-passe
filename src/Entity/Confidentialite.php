<?php

namespace App\Entity;

use App\Repository\ConfidentialiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfidentialiteRepository::class)]
class Confidentialite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $acces = null;

    #[ORM\ManyToMany(targetEntity: Motdepasse::class, mappedBy: 'access')]
    private Collection $motdepasses;

    public function __construct()
    {
        $this->motdepasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAcces(): ?string
    {
        return $this->acces;
    }

    public function setAcces(string $acces): self
    {
        $this->acces = $acces;

        return $this;
    }

    /**
     * @return Collection<int, Motdepasse>
     */
    public function getMotdepasses(): Collection
    {
        return $this->motdepasses;
    }

    public function addMotdepass(Motdepasse $motdepass): self
    {
        if (!$this->motdepasses->contains($motdepass)) {
            $this->motdepasses->add($motdepass);
            $motdepass->addAccess($this);
        }

        return $this;
    }

    public function removeMotdepass(Motdepasse $motdepass): self
    {
        if ($this->motdepasses->removeElement($motdepass)) {
            $motdepass->removeAccess($this);
        }

        return $this;
    }
}
