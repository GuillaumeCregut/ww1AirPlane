<?php

namespace App\Entity;

use App\Repository\AircraftRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, AircraftType>
     */
    #[ORM\ManyToMany(targetEntity: AircraftType::class, inversedBy: 'aircraft')]
    private Collection $type;

    public function __construct()
    {
        $this->type = new ArrayCollection();
    }


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

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

  /**
   * @return Collection<int, AircraftType>
   */
  public function getType(): Collection
  {
      return $this->type;
  }

  public function addType(AircraftType $type): static
  {
      if (!$this->type->contains($type)) {
          $this->type->add($type);
      }

      return $this;
  }

  public function removeType(AircraftType $type): static
  {
      $this->type->removeElement($type);

      return $this;
  }
}
