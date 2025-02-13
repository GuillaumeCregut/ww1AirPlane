<?php

namespace App\Entity;

use App\Repository\AircraftTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AircraftTypeRepository::class)]
class AircraftType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Aircraft>
     */
    #[ORM\ManyToMany(targetEntity: Aircraft::class, mappedBy: 'type')]
    private Collection $aircraft;

    public function __construct()
    {
       // $this->aircraft = new ArrayCollection();
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
           $aircraft->addType($this);
       }

       return $this;
   }

   public function removeAircraft(Aircraft $aircraft): static
   {
       if ($this->aircraft->removeElement($aircraft)) {
           $aircraft->removeType($this);
       }

       return $this;
   }
}
