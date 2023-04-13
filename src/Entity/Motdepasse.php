<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Assert\NotBlank;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MotdepasseRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: MotdepasseRepository::class)]
class Motdepasse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    

    #[Assert\NotBlank(message : 'Ce champ ne doit pas être vide')]
    #[ORM\Column(length: 255)]
    private ?string $website = null;

    #[Assert\NotBlank(message : 'Ce champ ne doit pas être vide')]
    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[Assert\NotBlank(message : 'Ce champ ne doit pas être vide')]
    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: Confidentialite::class, inversedBy: 'motdepasses')]
    private Collection $access;

    #[ORM\ManyToOne(inversedBy: 'motDePasse')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
