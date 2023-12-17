<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\OneToMany(mappedBy: 'Type', targetEntity: Category::class)]
    private Collection $Categories;

    #[ORM\OneToMany(mappedBy: 'Type', targetEntity: Tag::class)]
    private Collection $Tags;

    public function __construct()
    {
        $this->Categories = new ArrayCollection();
        $this->Tags = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->Name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): static
    {
        $this->Name = $Name;

        return $this;
    }

    /**
     * @return Collection<int, Category>
     */
    public function getCategories(): Collection
    {
        return $this->Categories;
    }

    public function addCategory(Category $category): static
    {
        if (!$this->Categories->contains($category)) {
            $this->Categories->add($category);
            $category->setType($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): static
    {
        if ($this->Categories->removeElement($category)) {
            // set the owning side to null (unless already changed)
            if ($category->getType() === $this) {
                $category->setType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->Tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->Tags->contains($tag)) {
            $this->Tags->add($tag);
            $tag->setType($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        if ($this->Tags->removeElement($tag)) {
            // set the owning side to null (unless already changed)
            if ($tag->getType() === $this) {
                $tag->setType(null);
            }
        }

        return $this;
    }
}
