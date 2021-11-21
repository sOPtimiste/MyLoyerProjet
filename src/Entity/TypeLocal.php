<?php

namespace App\Entity;

use App\Repository\TypeLocalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TypeLocalRepository::class)
 */
class TypeLocal
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
    private $type;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Local::class, mappedBy="typeLocal", orphanRemoval=true,cascade={"persist","remove"})
     */
    private $locals;

    public function __construct()
    {
        $this->locals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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
            $local->setTypeLocal($this);
        }

        return $this;
    }

    public function removeLocal(Local $local): self
    {
        if ($this->locals->removeElement($local)) {
            // set the owning side to null (unless already changed)
            if ($local->getTypeLocal() === $this) {
                $local->setTypeLocal(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->type.', '.$this->description;
    }

    
}
