<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AssetCategoriesRepository")
 */
class AssetCategories
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
    private $categoryname;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Assets", mappedBy="category", orphanRemoval=true)
     */
    private $assets;

    public function __construct()
    {
        $this->assets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryname(): ?string
    {
        return $this->categoryname;
    }

    public function setCategoryname(?string $categoryname): self
    {
        $this->categoryname = $categoryname;

        return $this;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(?bool $active): self
    {
        $this->active = $active;

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
            $asset->setCategory($this);
        }

        return $this;
    }

    public function removeAsset(Assets $asset): self
    {
        if ($this->assets->contains($asset)) {
            $this->assets->removeElement($asset);
            // set the owning side to null (unless already changed)
            if ($asset->getCategory() === $this) {
                $asset->setCategory(null);
            }
        }

        return $this;
    }
}
