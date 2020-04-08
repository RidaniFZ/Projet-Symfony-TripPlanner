<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembreRepository")
 */
class Membre
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $MotDePass;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Groupe", inversedBy="membresGroupe")
     */
    private $groupeAppartenance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Groupe", mappedBy="adminGroupe")
     */
    private $groupesGerer;

    public function __construct()
    {
        $this->groupeAppartenance = new ArrayCollection();
        $this->groupesGerer = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(?string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->Adress;
    }

    public function setAdress(string $Adress): self
    {
        $this->Adress = $Adress;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function getMotDePass(): ?string
    {
        return $this->MotDePass;
    }

    public function setMotDePass(string $MotDePass): self
    {
        $this->MotDePass = $MotDePass;

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupeAppartenance(): Collection
    {
        return $this->groupeAppartenance;
    }

    public function addGroupeAppartenance(Groupe $groupeAppartenance): self
    {
        if (!$this->groupeAppartenance->contains($groupeAppartenance)) {
            $this->groupeAppartenance[] = $groupeAppartenance;
        }

        return $this;
    }

    public function removeGroupeAppartenance(Groupe $groupeAppartenance): self
    {
        if ($this->groupeAppartenance->contains($groupeAppartenance)) {
            $this->groupeAppartenance->removeElement($groupeAppartenance);
        }

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupesGerer(): Collection
    {
        return $this->groupesGerer;
    }

    public function addGroupesGerer(Groupe $groupesGerer): self
    {
        if (!$this->groupesGerer->contains($groupesGerer)) {
            $this->groupesGerer[] = $groupesGerer;
            $groupesGerer->setAdminGroupe($this);
        }

        return $this;
    }

    public function removeGroupesGerer(Groupe $groupesGerer): self
    {
        if ($this->groupesGerer->contains($groupesGerer)) {
            $this->groupesGerer->removeElement($groupesGerer);
            // set the owning side to null (unless already changed)
            if ($groupesGerer->getAdminGroupe() === $this) {
                $groupesGerer->setAdminGroupe(null);
            }
        }

        return $this;
    }
}
