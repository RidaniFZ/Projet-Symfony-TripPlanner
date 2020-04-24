<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pays;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Image;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Groupe", inversedBy="userGroupe")
     */
    private $groupesAppartenance;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Groupe", mappedBy="AdminGroupe")
     */
    private $groupesGerer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trip", mappedBy="TripAdmin")
     */
    private $UserTrips;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $description;

    public function __construct()
    {
        $this->groupesAppartenance = new ArrayCollection();
        $this->groupesGerer = new ArrayCollection();
        $this->UserTrips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function setPays(string $Pays): self
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
    
    public function getImage()
    {
        return $this->Image;
    }

    public function setImage($Image): self
    {
        $this->Image = $Image;

        return $this;
    }

    /**
     * @return Collection|Groupe[]
     */
    public function getGroupesAppartenance(): Collection
    {
        return $this->groupesAppartenance;
    }

    public function addGroupesAppartenance(Groupe $groupesAppartenance): self
    {
        if (!$this->groupesAppartenance->contains($groupesAppartenance)) {
            $this->groupesAppartenance[] = $groupesAppartenance;
        }

        return $this;
    }

    public function removeGroupesAppartenance(Groupe $groupesAppartenance): self
    {
        if ($this->groupesAppartenance->contains($groupesAppartenance)) {
            $this->groupesAppartenance->removeElement($groupesAppartenance);
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

    /**
     * @return Collection|Trip[]
     */
    public function getUserTrips(): Collection
    {
        return $this->UserTrips;
    }

    public function addUserTrip(Trip $userTrip): self
    {
        if (!$this->UserTrips->contains($userTrip)) {
            $this->UserTrips[] = $userTrip;
            $userTrip->setTripAdmin($this);
        }

        return $this;
    }

    public function removeUserTrip(Trip $userTrip): self
    {
        if ($this->UserTrips->contains($userTrip)) {
            $this->UserTrips->removeElement($userTrip);
            // set the owning side to null (unless already changed)
            if ($userTrip->getTripAdmin() === $this) {
                $userTrip->setTripAdmin(null);
            }
        }

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
