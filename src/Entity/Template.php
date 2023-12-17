<?php

namespace App\Entity;

use App\Repository\TemplateRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemplateRepository::class)]
class Template
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'Template', targetEntity: Category::class)]
    private Collection $Templates;

    public function __construct()
    {
        $this->Templates = new ArrayCollection();
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
     * @return Collection<int, Category>
     */
    public function getTemplates(): Collection
    {
        return $this->Templates;
    }

    public function addTemplate(Category $template): static
    {
        if (!$this->Templates->contains($template)) {
            $this->Templates->add($template);
            $template->setTemplate($this);
        }

        return $this;
    }

    public function removeTemplate(Category $template): static
    {
        if ($this->Templates->removeElement($template)) {
            // set the owning side to null (unless already changed)
            if ($template->getTemplate() === $this) {
                $template->setTemplate(null);
            }
        }

        return $this;
    }

}
