<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GroupeRepository")
 */
class Groupe
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
     * @ORM\Column(type="string", length=500)
     */
    private $Description;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Membre", mappedBy="groupeAppartenance")
     */
    private $membresGroupe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Membre", inversedBy="groupesGerer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adminGroupe;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Trip", mappedBy="tripGroupe", cascade={"persist", "remove"})
     */
    private $groupeTrip;

    public function __construct()
    {
        $this->membresGroupe = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    /**
     * @return Collection|Membre[]
     */
    public function getMembresGroupe(): Collection
    {
        return $this->membresGroupe;
    }

    public function addMembresGroupe(Membre $membresGroupe): self
    {
        if (!$this->membresGroupe->contains($membresGroupe)) {
            $this->membresGroupe[] = $membresGroupe;
            $membresGroupe->addGroupeAppartenance($this);
        }

        return $this;
    }

    public function removeMembresGroupe(Membre $membresGroupe): self
    {
        if ($this->membresGroupe->contains($membresGroupe)) {
            $this->membresGroupe->removeElement($membresGroupe);
            $membresGroupe->removeGroupeAppartenance($this);
        }

        return $this;
    }

    public function getAdminGroupe(): ?Membre
    {
        return $this->adminGroupe;
    }

    public function setAdminGroupe(?Membre $adminGroupe): self
    {
        $this->adminGroupe = $adminGroupe;

        return $this;
    }

    public function getGroupeTrip(): ?Trip
    {
        return $this->groupeTrip;
    }

    public function setGroupeTrip(Trip $groupeTrip): self
    {
        $this->groupeTrip = $groupeTrip;

        // set the owning side of the relation if necessary
        if ($groupeTrip->getTripGroupe() !== $this) {
            $groupeTrip->setTripGroupe($this);
        }

        return $this;
    }
}
