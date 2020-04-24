<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TripRepository")
 */
class Trip
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
    private $Destination;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateDebut;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFin;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Groupe", inversedBy="groupeTrip", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $tripGroupe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hebergement", inversedBy="Trips")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tripHebergement;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Activit", inversedBy="Trips")
     */
    private $TripActivities;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="UserTrips")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TripAdmin;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $description;

    public function __construct()
    {
        $this->TripActivities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestination(): ?string
    {
        return $this->Destination;
    }

    public function setDestination(string $Destination): self
    {
        $this->Destination = $Destination;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getTripGroupe(): ?Groupe
    {
        return $this->tripGroupe;
    }

    public function setTripGroupe(Groupe $tripGroupe): self
    {
        $this->tripGroupe = $tripGroupe;

        return $this;
    }

    public function getTripHebergement(): ?Hebergement
    {
        return $this->tripHebergement;
    }

    public function setTripHebergement(?Hebergement $tripHebergement): self
    {
        $this->tripHebergement = $tripHebergement;

        return $this;
    }

    /**
     * @return Collection|Activit[]
     */
    public function getTripActivities(): Collection
    {
        return $this->TripActivities;
    }

    public function addTripActivity(Activit $tripActivity): self
    {
        if (!$this->TripActivities->contains($tripActivity)) {
            $this->TripActivities[] = $tripActivity;
        }

        return $this;
    }

    public function removeTripActivity(Activit $tripActivity): self
    {
        if ($this->TripActivities->contains($tripActivity)) {
            $this->TripActivities->removeElement($tripActivity);
        }

        return $this;
    }

    public function getTripAdmin(): ?User
    {
        return $this->TripAdmin;
    }

    public function setTripAdmin(?User $TripAdmin): self
    {
        $this->TripAdmin = $TripAdmin;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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
}
