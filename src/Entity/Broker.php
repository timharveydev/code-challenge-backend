<?php

namespace App\Entity;

use App\Repository\BrokerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BrokerRepository::class)]
class Broker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?int $premium = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPremium(): ?int
    {
        return $this->premium;
    }

    public function setPremium(int $premium): self
    {
        $this->premium = $premium;

        return $this;
    }
}
