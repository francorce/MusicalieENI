<?php

namespace App\Entity;

use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomScene = null;

    #[ORM\Column(length: 255)]
    private ?string $Style = null;

    #[ORM\ManyToMany(targetEntity: Festival::class, mappedBy: 'artiste')]
    private Collection $festivals;

    #[ORM\OneToMany(mappedBy: 'artiste', targetEntity: Instrument::class, cascade: ['persist'],orphanRemoval: true)]
    private Collection $instrument;

    public function __construct()
    {
        $this->festivals = new ArrayCollection();
        $this->instrument = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomScene(): ?string
    {
        return $this->NomScene;
    }

    public function setNomScene(string $NomScene): self
    {
        $this->NomScene = $NomScene;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->Style;
    }

    public function setStyle(string $Style): self
    {
        $this->Style = $Style;

        return $this;
    }


    /**
     * @return Collection<int, Festival>
     */
    public function getFestivals(): Collection
    {
        return $this->festivals;
    }

    public function addFestival(Festival $festival): self
    {
        if (!$this->festivals->contains($festival)) {
            $this->festivals->add($festival);
            $festival->addArtiste($this);
        }

        return $this;
    }

    public function removeFestival(Festival $festival): self
    {
        if ($this->festivals->removeElement($festival)) {
            $festival->removeArtiste($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, Instrument>
     */
    public function getInstrument(): Collection
    {
        return $this->instrument;
    }

    public function addInstrument(Instrument $instrument): self
    {
        if (!$this->instrument->contains($instrument)) {
            $this->instrument->add($instrument);
            $instrument->setArtiste($this);
        }

        return $this;
    }

    public function removeInstrument(Instrument $instrument): self
    {
        if ($this->instrument->removeElement($instrument)) {
            // set the owning side to null (unless already changed)
            if ($instrument->getArtiste() === $this) {
                $instrument->setArtiste(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->NomScene;
    }

}
