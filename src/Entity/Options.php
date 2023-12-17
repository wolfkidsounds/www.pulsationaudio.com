<?php

namespace App\Entity;

use App\Repository\OptionsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OptionsRepository::class)]
class Options
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Name = null;

    #[ORM\OneToMany(mappedBy: 'Options', targetEntity: Content::class)]
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
            $content->setOptions($this);
        }

        return $this;
    }

    public function removeContent(Content $content): static
    {
        if ($this->Contents->removeElement($content)) {
            // set the owning side to null (unless already changed)
            if ($content->getOptions() === $this) {
                $content->setOptions(null);
            }
        }

        return $this;
    }
}
