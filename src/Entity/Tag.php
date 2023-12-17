<?php

namespace App\Entity;

use App\Repository\TagRepository;
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
    private ?string $Name = null;

    #[ORM\ManyToOne(inversedBy: 'Tags')]
    private ?Category $Category = null;

    #[ORM\ManyToOne(inversedBy: 'Tags')]
    private ?Type $Type = null;

    #[ORM\ManyToMany(targetEntity: Content::class, mappedBy: 'Tags')]
    private Collection $Contents;

    public function __construct()
    {
        $this->Contents = new ArrayCollection();
    }

    public function __toString() {
        if ($this->getType()) {
            return $this->Name . ' (Type: ' . $this->getType() . ')';
        }

        else if ($this->getCategory()) {
            return $this->Name . ' (Category: ' . $this->getCategory() . ')';
        }

        else if ($this->getType() && $this->getCategory()) {
            return $this->Name . ' (Type: ' . $this->getType() . ') - ' . '(Category: ' . $this->getCategory() . ')';
        } 
        
        else {
            return $this->Name;
        }
        
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

    public function getCategory(): ?Category
    {
        return $this->Category;
    }

    public function setCategory(?Category $Category): static
    {
        $this->Category = $Category;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->Type;
    }

    public function setType(?Type $Type): static
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * @return Collection<int, Content>
     */
    public function getContents(): Collection
    {
        return $this->Contents;
    }

    public function addContent(Content $content): static
    {
        if (!$this->Contents->contains($content)) {
            $this->Contents->add($content);
            $content->addTag($this);
        }

        return $this;
    }

    public function removeContent(Content $content): static
    {
        if ($this->Contents->removeElement($content)) {
            $content->removeTag($this);
        }

        return $this;
    }
}
