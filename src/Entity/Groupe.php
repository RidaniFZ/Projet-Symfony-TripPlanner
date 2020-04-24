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
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="groupesAppartenance")
     */
    private $userGroupe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="groupesGerer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $adminGroupe;

     /**
     * @ORM\OneToOne(targetEntity="App\Entity\Trip", mappedBy="tripGroupe", cascade={"persist", "remove"})
     */
    private $groupeTrip; 

    public function __construct()
    {
        $this->userGroupe = new ArrayCollection();
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
     * @return Collection|User[]
     */
    public function getUserGroupe(): Collection
    {
        return $this->userGroupe;
    }

    public function addUserGroupe(User $userGroupe): self
    {
        if (!$this->userGroupe->contains($userGroupe)) {
            $this->userGroupe[] = $userGroupe;
            $userGroupe->addGroupesAppartenance($this);
        }

        return $this;
    }

    public function removeUserGroupe(User $userGroupe): self
    {
        if ($this->userGroupe->contains($userGroupe)) {
            $this->userGroupe->removeElement($userGroupe);
            $userGroupe->removeGroupesAppartenance($this);
        }

        return $this;
    }

    public function getAdminGroupe(): ?User
    {
        return $this->adminGroupe;
    }

    public function setAdminGroupe(?User $adminGroupe): self
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
