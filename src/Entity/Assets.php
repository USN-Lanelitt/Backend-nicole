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
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $assetname;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $asset_condition;

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

    public function getAssetname(): ?string
    {
        return $this->assetname;
    }

    public function setAssetname(?string $assetname): self
    {
        $this->assetname = $assetname;

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

    public function getAssetCondition(): ?string
    {
        return $this->asset_condition;
    }

    public function setAssetCondition(?string $asset_condition): self
    {
        $this->asset_condition = $asset_condition;

        return $this;
    }
}
