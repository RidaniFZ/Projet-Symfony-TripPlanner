<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActivitRepository")
 */
class Activit
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
    private $Type;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $Description;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $Prix;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Trip", mappedBy="TripActivities")
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

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

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

    public function getPrix(): ?string
    {
        return $this->Prix;
    }

    public function setPrix(string $Prix): self
    {
        $this->Prix = $Prix;

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
            $trip->addTripActivity($this);
        }

        return $this;
    }

    public function removeTrip(Trip $trip): self
    {
        if ($this->Trips->contains($trip)) {
            $this->Trips->removeElement($trip);
            $trip->removeTripActivity($this);
        }

        return $this;
    }
}
