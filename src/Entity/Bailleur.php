<?php

namespace App\Entity;

use App\Repository\BailleurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BailleurRepository::class)
 */
class Bailleur 
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lieu_de_travail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_agence;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbr_immeuble;

    /**
     * @ORM\OneToMany(targetEntity=Local::class, mappedBy="bailleur", orphanRemoval=true)
     */
    private $locals;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="bailleur")
     */
    private $users;

    public function __construct()
    {
        $this->locals = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLieuDeTravail(): ?string
    {
        return $this->lieu_de_travail;
    }

    public function setLieuDeTravail(string $lieu_de_travail): self
    {
        $this->lieu_de_travail = $lieu_de_travail;

        return $this;
    }

    public function getNomAgence(): ?string
    {
        return $this->nom_agence;
    }

    public function setNomAgence(string $nom_agence): self
    {
        $this->nom_agence = $nom_agence;

        return $this;
    }

    public function getNbrImmeuble(): ?int
    {
        return $this->nbr_immeuble;
    }

    public function setNbrImmeuble(int $nbr_immeuble): self
    {
        $this->nbr_immeuble = $nbr_immeuble;

        return $this;
    }

    /**
     * @return Collection|Local[]
     */
    public function getLocals(): Collection
    {
        return $this->locals;
    }

    public function addLocal(Local $local): self
    {
        if (!$this->locals->contains($local)) {
            $this->locals[] = $local;
            $local->setBailleur($this);
        }

        return $this;
    }

    public function removeLocal(Local $local): self
    {
        if ($this->locals->removeElement($local)) {
            // set the owning side to null (unless already changed)
            if ($local->getBailleur() === $this) {
                $local->setBailleur(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setBailleur($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getBailleur() === $this) {
                $user->setBailleur(null);
            }
        }

        return $this;
    }
}
