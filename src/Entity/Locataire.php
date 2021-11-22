<?php

namespace App\Entity;

use App\Repository\LocataireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocataireRepository::class)
 */
class Locataire 
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
    private $tuteur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tel_tuteur;

    /**
     * @ORM\OneToOne(targetEntity=Contrat::class, cascade={"persist", "remove"})
     */
    private $contrat;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="locataire")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="locataire")
     */
    private $messages;

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTuteur(): ?string
    {
        return $this->tuteur;
    }

    public function setTuteur(string $tuteur): self
    {
        $this->tuteur = $tuteur;

        return $this;
    }

    public function getTelTuteur(): ?string
    {
        return $this->tel_tuteur;
    }

    public function setTelTuteur(string $tel_tuteur): self
    {
        $this->tel_tuteur = $tel_tuteur;

        return $this;
    }

    public function getContrat(): ?Contrat
    {
        return $this->contrat;
    }

    public function setContrat(?Contrat $contrat): self
    {
        $this->contrat = $contrat;

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
            $user->setLocataire($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getLocataire() === $this) {
                $user->setLocataire(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setLocataire($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getLocataire() === $this) {
                $message->setLocataire(null);
            }
        }

        return $this;
    }
}
