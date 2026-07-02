<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $email = null;

    #[ORM\Column(length: 50)]
    private ?string $password = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Consumer $consumer = null;

    #[ORM\OneToOne(mappedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Business $business = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getConsumer(): ?Consumer
    {
        return $this->consumer;
    }

    public function setConsumer(?Consumer $consumer): static
    {
        // unset the owning side of the relation if necessary
        if ($consumer === null && $this->consumer !== null) {
            $this->consumer->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($consumer !== null && $consumer->getUser() !== $this) {
            $consumer->setUser($this);
        }

        $this->consumer = $consumer;

        return $this;
    }

    public function getBusiness(): ?Business
    {
        return $this->business;
    }

    public function setBusiness(?Business $business): static
    {
        // unset the owning side of the relation if necessary
        if ($business === null && $this->business !== null) {
            $this->business->setUser(null);
        }

        // set the owning side of the relation if necessary
        if ($business !== null && $business->getUser() !== $this) {
            $business->setUser($this);
        }

        $this->business = $business;

        return $this;
    }
}
