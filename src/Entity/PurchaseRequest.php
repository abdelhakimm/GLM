<?php

namespace App\Entity;

use App\Repository\PurchaseRequestRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PurchaseRequestRepository::class)]
class PurchaseRequest
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_request = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column(length: 20)]
    private ?string $name = null;

    #[ORM\Column]
    private ?float $price_request = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRequest(): ?\DateTimeInterface
    {
        return $this->date_request;
    }

    public function setDateRequest(\DateTimeInterface $date_request): self
    {
        $this->date_request = $date_request;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
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

    public function getPriceRequest(): ?float
    {
        return $this->price_request;
    }

    public function setPriceRequest(float $price_request): self
    {
        $this->price_request = $price_request;

        return $this;
    }
}
