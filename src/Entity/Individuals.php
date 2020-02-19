<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IndividualsRepository")
 */
class Individuals
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $middlename;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $zipcode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profile_image;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Users", mappedBy="individ", cascade={"persist", "remove"})
     */
    private $testUsers;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Assets", mappedBy="individ", orphanRemoval=true)
     */
    private $assets;
    private $individConnections;
    private $Users;

    public function __construct()
    {
        $this->assets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getMiddlename(): ?string
    {
        return $this->middlename;
    }

    public function setMiddlename(?string $middlename): self
    {
        $this->middlename = $middlename;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getZipcode(): ?int
    {
        return $this->zipcode;
    }

    public function setZipcode(?int $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getMobile(): ?int
    {
        return $this->mobile;
    }

    public function setMobile(?int $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getProfileImage(): ?string
    {
        return $this->profile_image;
    }

    public function setProfileImage(?string $profile_image): self
    {
        $this->profile_image = $profile_image;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->Users;
    }

    public function setUsers(Users $users): self
    {
        $this->users = $users;

        // set the owning side of the relation if necessary
        if ($users->getIndivid() !== $this) {
            $users->setIndivid($this);
        }

        return $this;
    }

    /**
     * @return Collection|Assets[]
     */
    public function getAssets(): Collection
    {
        return $this->assets;
    }

    public function addAsset(Assets $asset): self
    {
        if (!$this->assets->contains($asset)) {
            $this->assets[] = $asset;
            $asset->setIndivid($this);
        }

        return $this;
    }

    public function removeAsset(Assets $asset): self
    {
        if ($this->assets->contains($asset)) {
            $this->assets->removeElement($asset);
            // set the owning side to null (unless already changed)
            if ($asset->getIndivid() === $this) {
                $asset->setIndivid(null);
            }
        }

        return $this;
    }
    /**
     * @return Collection|IndividConnections[]
     */
    /*public function getIndividConnection(): Collection
    {
        return $this->individConnections;
    }*/

    public function addIndividConnection(IndividConnections $individConnection): self
    {
        if (!$this->individConnections->contains($individConnection)) {
            $this->individConnections[] = $individConnection;
            $individConnection->setIndivid($this);
        }

        return $this;
    }

    public function removeIndividConnection(IndividConnections $individConnection): self
    {
        if ($this->individConnections->contains($individConnection)) {
            $this->individConnections->removeElement($individConnection);
            // set the owning side to null (unless already changed)
            if ($individConnection->getIndivid() === $this) {
                $individConnection->setIndivid(null);
            }
        }

        return $this;
    }
}
