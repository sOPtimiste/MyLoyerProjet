<?php

namespace App\Entity;

use App\Repository\SuperviseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuperviseurRepository::class)
 */
class Superviseur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_de_lieu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_du_ministere;

    /**
     * @ORM\OneToMany(targetEntity=Contrat::class, mappedBy="superviseur")
     */
    private $contrats;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="superviseur")
     */
    private $users;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumDeLieu(): ?int
    {
        return $this->num_de_lieu;
    }

    public function setNumDeLieu(int $num_de_lieu): self
    {
        $this->num_de_lieu = $num_de_lieu;

        return $this;
    }

    public function getNomDuMinistere(): ?string
    {
        return $this->nom_du_ministere;
    }

    public function setNomDuMinistere(string $nom_du_ministere): self
    {
        $this->nom_du_ministere = $nom_du_ministere;

        return $this;
    }

    /**
     * @return Collection|Contrat[]
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
            $contrat->setSuperviseur($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->removeElement($contrat)) {
            // set the owning side to null (unless already changed)
            if ($contrat->getSuperviseur() === $this) {
                $contrat->setSuperviseur(null);
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
            $user->setSuperviseur($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getSuperviseur() === $this) {
                $user->setSuperviseur(null);
            }
        }

        return $this;
    }
}
