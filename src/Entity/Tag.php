<?php

namespace App\Entity;

use App\Repository\Implementation\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    /**
     * @var Collection<int, SparePart>
     */
    #[ORM\ManyToMany(targetEntity: SparePart::class, mappedBy: 'Tags')]
    private Collection $spareParts;

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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

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
            $sparePart->addTag($this);
        }

        return $this;
    }

    public function removeSparePart(SparePart $sparePart): static
    {
        if ($this->spareParts->removeElement($sparePart)) {
            $sparePart->removeTag($this);
        }

        return $this;
    }
}
