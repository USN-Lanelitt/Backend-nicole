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
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $middleName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Assets", mappedBy="individ", orphanRemoval=true)
     */
    private $assets;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IndividConnections", mappedBy="individ1")
     */
    private $individConnections;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\IndividConnections", mappedBy="individ2")
     */
    private $individConnections2;

    public function __construct()
    {
        $this->assets = new ArrayCollection();
        $this->individConnections = new ArrayCollection();
        $this->individConnections2 = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getMiddleName(): ?string
    {
        return $this->middleName;
    }

    public function setMiddleName(?string $middleName): self
    {
        $this->middleName = $middleName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

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
    public function getIndividConnections(): Collection
    {
        return $this->individConnections;
    }

    public function addIndividConnections(IndividConnections $individConnections): self
    {
        if (!$this->individConnections->contains($individConnections)) {
            $this->individConnections[] = $individConnections;
            $individConnections->setIndivid1($this);
        }

        return $this;
    }

    public function removeIndividConnections(IndividConnections $individConnections): self
    {
        if ($this->individConnections->contains($individConnections)) {
            $this->individConnections->removeElement($individConnections);
            // set the owning side to null (unless already changed)
            if ($individConnections->getIndivid1() === $this) {
                $individConnections->setIndivid1(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|IndividConnections[]
     */
    public function getIndividConnections2(): Collection
    {
        return $this->individConnections2;
    }

    public function addIndividConnections2(IndividConnections $individConnections2): self
    {
        if (!$this->individConnections2->contains($individConnections2)) {
            $this->individConnections2[] = $individConnections2;
            $individConnections2->setIndivid2($this);
        }

        return $this;
    }

    public function removeIndividConnections2(IndividConnections $individConnections2): self
    {
        if ($this->individConnections2->contains($individConnections2)) {
            $this->individConnections2->removeElement($individConnections2);
            // set the owning side to null (unless already changed)
            if ($individConnections2->getIndivid2() === $this) {
                $individConnections2->setIndivid2(null);
            }
        }

        return $this;
    }
}