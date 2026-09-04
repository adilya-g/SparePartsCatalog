<?php

namespace App\Entity;

use App\Repository\Implementation\CombineRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CombineRepository::class)]
class Combine
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $model = null;

    /**
     * @var Collection<int, SparePart>
     */
    #[ORM\OneToMany(targetEntity: SparePart::class, mappedBy: 'combine')]
    private Collection $spareParts;

    #[ORM\Column]
    private ?bool $isActive = null;

    public function __construct()
    {
        $this->spareParts = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(?string $model): static
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return Collection<int, SparePart>
     */
    public function getSpareParts(): Collection
    {
        return $this->spareParts;
    }

    public function addSparePart(SparePart $sparePart): static
    {
        if (!$this->spareParts->contains($sparePart)) {
            $this->spareParts->add($sparePart);
            $sparePart->setCombine($this);
        }

        return $this;
    }

    public function removeSparePart(SparePart $sparePart): static
    {
        if ($this->spareParts->removeElement($sparePart)) {
            // set the owning side to null (unless already changed)
            if ($sparePart->getCombine() === $this) {
                $sparePart->setCombine(null);
            }
        }

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}
