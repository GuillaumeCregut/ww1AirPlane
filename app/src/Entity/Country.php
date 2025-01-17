<?php

namespace App\Entity;

use App\Repository\CountryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    /**
     * @var Collection<int, Builder>
     */
    #[ORM\OneToMany(targetEntity: Builder::class, mappedBy: 'country')]
    private Collection $builders;

    public function __construct()
    {
        $this->builders = new ArrayCollection();
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
     * @return Collection<int, Builder>
     */
    public function getBuilders(): Collection
    {
        return $this->builders;
    }

    public function addBuilder(Builder $builder): static
    {
        if (!$this->builders->contains($builder)) {
            $this->builders->add($builder);
            $builder->setCountry($this);
        }

        return $this;
    }

    public function removeBuilder(Builder $builder): static
    {
        if ($this->builders->removeElement($builder)) {
            // set the owning side to null (unless already changed)
            if ($builder->getCountry() === $this) {
                $builder->setCountry(null);
            }
        }

        return $this;
    }
}
