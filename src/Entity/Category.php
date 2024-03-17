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
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\ManyToOne(inversedBy: 'Categories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Type $Type = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'Templates')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Template $Template = null;

    #[ORM\Column]
    private ?int $OrderNr = null;

    #[ORM\OneToMany(mappedBy: 'Category', targetEntity: Content::class)]
    private Collection $Contents;

    public function __construct()
    {
        $this->Contents = new ArrayCollection();
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

    public function getType(): ?Type
    {
        return $this->Type;
    }

    public function setType(?Type $Type): static
    {
        $this->Type = $Type;

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

    public function getTemplate(): ?Template
    {
        return $this->Template;
    }

    public function setTemplate(?Template $Template): static
    {
        $this->Template = $Template;

        return $this;
    }

    public function getOrderNr(): ?int
    {
        return $this->OrderNr;
    }

    public function setOrderNr(int $OrderNr): static
    {
        $this->OrderNr = $OrderNr;

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
            $content->setCategory($this);
        }

        return $this;
    }

    public function removeContent(Content $content): static
    {
        if ($this->Contents->removeElement($content)) {
            // set the owning side to null (unless already changed)
            if ($content->getCategory() === $this) {
                $content->setCategory(null);
            }
        }

        return $this;
    }
}
