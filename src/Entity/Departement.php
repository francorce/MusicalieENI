<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DepartementRepository::class)]
class Departement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column]
    private ?int $Numero = null;

    #[ORM\OneToMany(mappedBy: 'departement', targetEntity: Festival::class)]
    private Collection $festival;


    public function __construct()
    {
        $this->festival = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getNumero(): ?int
    {
        return $this->Numero;
    }

    public function setNumero(int $Numero): self
    {
        $this->Numero = $Numero;

        return $this;
    }

    /**
     * @return Collection<int, Festival>
     */
    public function getFestival(): Collection
    {
        return $this->festival;
    }

    public function addFestival(Festival $festival): self
    {
        if (!$this->festival->contains($festival)) {
            $this->festival->add($festival);
            $festival->setDepartement($this);
        }

        return $this;
    }

    public function removeFestival(Festival $festival): self
    {
        if ($this->festival->removeElement($festival)) {
            // set the owning side to null (unless already changed)
            if ($festival->getDepartement() === $this) {
                $festival->setDepartement(null);
            }
        }

        return $this;
    }


}
