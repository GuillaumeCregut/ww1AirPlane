<?php

namespace App\Entity;

use App\Repository\BuilderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BuilderRepository::class)]
class Builder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'builders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Country $country = null;

    /**
     * @var Collection<int, Aircraft>
     */
    #[ORM\OneToMany(targetEntity: Aircraft::class, mappedBy: 'builder')]
    private Collection $aircraft;

    public function __construct()
    {
        $this->aircraft = new ArrayCollection();
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

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): static
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, Aircraft>
     */
    public function getAircraft(): Collection
    {
        return $this->aircraft;
    }

    public function addAircraft(Aircraft $aircraft): static
    {
        if (!$this->aircraft->contains($aircraft)) {
            $this->aircraft->add($aircraft);
            $aircraft->setBuilder($this);
        }

        return $this;
    }

    public function removeAircraft(Aircraft $aircraft): static
    {
        if ($this->aircraft->removeElement($aircraft)) {
            // set the owning side to null (unless already changed)
            if ($aircraft->getBuilder() === $this) {
                $aircraft->setBuilder(null);
            }
        }

        return $this;
    }
}
