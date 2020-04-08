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
}
