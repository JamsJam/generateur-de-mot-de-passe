<?php

namespace App\Entity;

use App\Repository\MotdepasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MotdepasseRepository::class)]
class Motdepasse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $website = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: Confidentialite::class, inversedBy: 'motdepasses')]
    private Collection $access;

    public function __construct()
    {
        $this->access = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Confidentialite>
     */
    public function getAccess(): Collection
    {
        return $this->access;
    }

    public function addAccess(Confidentialite $access): self
    {
        if (!$this->access->contains($access)) {
            $this->access->add($access);
        }

        return $this;
    }

    public function removeAccess(Confidentialite $access): self
    {
        $this->access->removeElement($access);

        return $this;
    }
}
