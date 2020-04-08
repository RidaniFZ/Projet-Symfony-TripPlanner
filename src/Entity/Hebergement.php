<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HebergementRepository")
 */
class Hebergement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $Adress;

    /**
     * @ORM\Column(type="decimal", precision=2, scale=2)
     */
    private $prixParNuit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trip", mappedBy="tripHebergement")
     */
    private $Trips;

    public function __construct()
    {
        $this->Trips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPrixParNuit(): ?string
    {
        return $this->prixParNuit;
    }

    public function setPrixParNuit(string $prixParNuit): self
    {
        $this->prixParNuit = $prixParNuit;

        return $this;
    }

    /**
     * @return Collection|Trip[]
     */
    public function getTrips(): Collection
    {
        return $this->Trips;
    }

    public function addTrip(Trip $trip): self
    {
        if (!$this->Trips->contains($trip)) {
            $this->Trips[] = $trip;
            $trip->setTripHebergement($this);
        }

        return $this;
    }

    public function removeTrip(Trip $trip): self
    {
        if ($this->Trips->contains($trip)) {
            $this->Trips->removeElement($trip);
            // set the owning side to null (unless already changed)
            if ($trip->getTripHebergement() === $this) {
                $trip->setTripHebergement(null);
            }
        }

        return $this;
    }
}
