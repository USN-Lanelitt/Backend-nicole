<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssetsRepository")
 */
class Assets
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Individuals", inversedBy="assets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $individ;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\AssetCategories", inversedBy="assets")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $assetName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIndivid(): ?Individuals
    {
        return $this->individ;
    }

    public function setIndivid(?Individuals $individ): self
    {
        $this->individ = $individ;

        return $this;
    }

    public function getCategory(): ?AssetCategories
    {
        return $this->category;
    }

    public function setCategory(?AssetCategories $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getAssetName(): ?string
    {
        return $this->assetName;
    }

    public function setAssetName(?string $assetName): self
    {
        $this->assetName = $assetName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}