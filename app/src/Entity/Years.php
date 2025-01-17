<?php

namespace App\Entity;

use App\Repository\YearsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: YearsRepository::class)]
class Years
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 5)]
    private ?string $name = null;

    /**
     * @var Collection<int, Aircraft>
     */
    #[ORM\OneToMany(targetEntity: Aircraft::class, mappedBy: 'dateIn')]
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
            $aircraft->setDateIn($this);
        }

        return $this;
    }

    public function removeAircraft(Aircraft $aircraft): static
    {
        if ($this->aircraft->removeElement($aircraft)) {
            // set the owning side to null (unless already changed)
            if ($aircraft->getDateIn() === $this) {
                $aircraft->setDateIn(null);
            }
        }

        return $this;
    }
}
