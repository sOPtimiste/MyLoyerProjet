<?php

namespace App\Entity;

use App\Repository\ContratRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ContratRepository::class)
 * @ORM\HasLifecycleCallbacks()
 */
class Contrat
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $typeContrat;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateContrat;

    /**
     * @ORM\Column(type="integer")
     */
    private $duree_de_bail;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $montant_de_cotion;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $montant_du_mensualite;

    /**
     * @ORM\OneToOne(targetEntity=Local::class, mappedBy="contrat",cascade={"persist", "remove"})
     */
    private $local;

    /**
     * @ORM\ManyToMany(targetEntity=Loi::class, inversedBy="contrats")
     */
    private $lois;

    /**
     * @ORM\ManyToOne(targetEntity=Superviseur::class, inversedBy="contrats")
     */
    private $superviseur;

    /**
     * @ORM\OneToOne(targetEntity=Locataire::class, inversedBy="no", cascade={"persist", "remove"})
     */
    private $locataire;

    public function __construct()
    {
        $this->lois = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTypeContrat(): ?string
    {
        return $this->typeContrat;
    }

    public function setTypeContrat(string $typeContrat): self
    {
        $this->typeContrat = $typeContrat;

        return $this;
    }

    public function getDateContrat(): ?\DateTimeInterface
    {
        return $this->dateContrat;
    }
    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */

    public function setDateContrat()
    {
        $this->dateContrat =  new \DateTime();

        //return $this;
    }

    public function getDureeDeBail(): ?int
    {
        return $this->duree_de_bail;
    }

    public function setDureeDeBail(int $duree_de_bail): self
    {
        $this->duree_de_bail = $duree_de_bail;

        return $this;
    }

    public function getMontantDeCotion(): ?string
    {
        return $this->montant_de_cotion;
    }

    public function setMontantDeCotion(string $montant_de_cotion): self
    {
        $this->montant_de_cotion = $montant_de_cotion;

        return $this;
    }

    public function getMontantDuMensualite(): ?string
    {
        return $this->montant_du_mensualite;
    }

    public function setMontantDuMensualite(string $montant_du_mensualite): self
    {
        $this->montant_du_mensualite = $montant_du_mensualite;

        return $this;
    }

    public function getLocal(): ?Local
    {
        return $this->local;
    }

    public function setLocal(Local $local): self
    {
        // set the owning side of the relation if necessary
        if ($local->getContrat() !== $this) {
            $local->setContrat($this);
        }

        $this->local = $local;

        return $this;
    }

    /**
     * @return Collection|Loi[]
     */
    public function getLois(): Collection
    {
        return $this->lois;
    }

    public function addLoi(Loi $loi): self
    {
        if (!$this->lois->contains($loi)) {
            $this->lois[] = $loi;
        }

        return $this;
    }

    public function removeLoi(Loi $loi): self
    {
        $this->lois->removeElement($loi);

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getSuperviseur(): ?Superviseur
    {
        return $this->superviseur;
    }

    public function setSuperviseur(?Superviseur $superviseur): self
    {
        $this->superviseur = $superviseur;

        return $this;
    }

    public function getLocataire(): ?Locataire
    {
        return $this->locataire;
    }

    public function setLocataire(?Locataire $locataire): self
    {
        $this->locataire = $locataire;

        return $this;
    }

}
