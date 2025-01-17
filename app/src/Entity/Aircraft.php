<?php

namespace App\Entity;

use App\Repository\AircraftRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AircraftRepository::class)]
class Aircraft
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'aircraft')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Years $dateIn = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fullDateIn = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Years $yearOut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fullDateOut = null;

    #[ORM\ManyToOne(inversedBy: 'aircraft')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Builder $builder = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDateIn(): ?Years
    {
        return $this->dateIn;
    }

    public function setDateIn(?Years $dateIn): static
    {
        $this->dateIn = $dateIn;

        return $this;
    }

    public function getFullDateIn(): ?\DateTimeInterface
    {
        return $this->fullDateIn;
    }

    public function setFullDateIn(\DateTimeInterface $fullDateIn): static
    {
        $this->fullDateIn = $fullDateIn;

        return $this;
    }

    public function getYearOut(): ?Years
    {
        return $this->yearOut;
    }

    public function setYearOut(?Years $yearOut): static
    {
        $this->yearOut = $yearOut;

        return $this;
    }

    public function getFullDateOut(): ?\DateTimeInterface
    {
        return $this->fullDateOut;
    }

    public function setFullDateOut(\DateTimeInterface $fullDateOut): static
    {
        $this->fullDateOut = $fullDateOut;

        return $this;
    }

    public function getBuilder(): ?Builder
    {
        return $this->builder;
    }

    public function setBuilder(?Builder $builder): static
    {
        $this->builder = $builder;

        return $this;
    }
}
