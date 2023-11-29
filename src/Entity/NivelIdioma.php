<?php

namespace App\Entity;

use App\Repository\NivelIdiomaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NivelIdiomaRepository::class)]
class NivelIdioma
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $Nombre = null;

    #[ORM\OneToMany(mappedBy: 'NivelIdioma', targetEntity: ConvocatoriaIdioma::class, orphanRemoval: true)]
    private Collection $convocatoriaIdiomas;

    public function __construct()
    {
        $this->convocatoriaIdiomas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): static
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * @return Collection<int, ConvocatoriaIdioma>
     */
    public function getConvocatoriaIdiomas(): Collection
    {
        return $this->convocatoriaIdiomas;
    }

    public function addConvocatoriaIdioma(ConvocatoriaIdioma $convocatoriaIdioma): static
    {
        if (!$this->convocatoriaIdiomas->contains($convocatoriaIdioma)) {
            $this->convocatoriaIdiomas->add($convocatoriaIdioma);
            $convocatoriaIdioma->setNivelIdioma($this);
        }

        return $this;
    }

    public function removeConvocatoriaIdioma(ConvocatoriaIdioma $convocatoriaIdioma): static
    {
        if ($this->convocatoriaIdiomas->removeElement($convocatoriaIdioma)) {
            // set the owning side to null (unless already changed)
            if ($convocatoriaIdioma->getNivelIdioma() === $this) {
                $convocatoriaIdioma->setNivelIdioma(null);
            }
        }

        return $this;
    }
}
