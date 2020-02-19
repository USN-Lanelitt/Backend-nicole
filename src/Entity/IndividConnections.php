<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IndividConnectionsRepository")
 */
class IndividConnections
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\individuals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $individ1;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\individuals")
     * @ORM\JoinColumn(nullable=false)
     */
    private $individ2;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $timestamp;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $connection_type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIndivid1(): ?individuals
    {
        return $this->individ1;
    }

    public function setIndivid1(?individuals $individ1): self
    {
        $this->individ1 = $individ1;

        return $this;
    }

    public function getIndivid2(): ?individuals
    {
        return $this->individ2;
    }

    public function setIndivid2(?individuals $individ2): self
    {
        $this->individ2 = $individ2;

        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(?\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    public function getConnectionType(): ?bool
    {
        return $this->connection_type;
    }

    public function setConnectionType(?bool $connection_type): self
    {
        $this->connection_type = $connection_type;

        return $this;
    }
}
