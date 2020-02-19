<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Individuals", inversedBy="Users", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $individ;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nickname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $usertype;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $active;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $news_subscription;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIndivid(): ?Individuals
    {
        return $this->individ;
    }

    public function setIndivid(Individuals $individ): self
    {
        $this->individ = $individ;

        return $this;
    }

    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    public function setNickname(?string $nickname): self
    {
        $this->nickname = $nickname;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getUsertype(): ?bool
    {
        return $this->usertype;
    }

    public function setUsertype(?bool $usertype): self
    {
        $this->usertype = $usertype;

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

    public function getNewsSubscription(): ?bool
    {
        return $this->news_subscription;
    }

    public function setNewsSubscription(?bool $news_subscription): self
    {
        $this->news_subscription = $news_subscription;

        return $this;
    }
}