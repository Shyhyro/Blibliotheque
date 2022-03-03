<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\ManyToOne(targetEntity: Rack::class, inversedBy: 'categories')]
    private $rack;

    #[ORM\OneToMany(mappedBy: 'category_fk', targetEntity: Book::class)]
    private $disponibility;

    public function __construct()
    {
        $this->disponibility = new ArrayCollection();
    }

    public function __toString(): string
    {
        // Je choisis de représenter une Category sous forme de string par son nom
        return $this->getName();
    }

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

    public function getRack(): ?Rack
    {
        return $this->rack;
    }

    public function setRack(?Rack $rack): self
    {
        $this->rack = $rack;

        return $this;
    }

    /**
     * @return Collection<int, Book>
     */
    public function getDisponibility(): Collection
    {
        return $this->disponibility;
    }

    public function addDisponibility(Book $disponibility): self
    {
        if (!$this->disponibility->contains($disponibility)) {
            $this->disponibility[] = $disponibility;
            $disponibility->setCategoryFk($this);
        }

        return $this;
    }

    public function removeDisponibility(Book $disponibility): self
    {
        if ($this->disponibility->removeElement($disponibility)) {
            // set the owning side to null (unless already changed)
            if ($disponibility->getCategoryFk() === $this) {
                $disponibility->setCategoryFk(null);
            }
        }

        return $this;
    }
}