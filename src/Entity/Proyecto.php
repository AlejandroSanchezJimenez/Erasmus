<?php

namespace App\Entity;

use App\Repository\ProyectoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProyectoRepository::class)]
class Proyecto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $Codigo = null;

    #[ORM\Column(length: 100)]
    private ?string $Nombre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Fecha_ini = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Fecha_fin = null;

    #[ORM\OneToMany(mappedBy: 'Proyecto', targetEntity: Convocatoria::class, orphanRemoval: true)]
    private Collection $convocatorias;

    public function __construct()
    {
        $this->convocatorias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodigo(): ?string
    {
        return $this->Codigo;
    }

    public function setCodigo(string $Codigo): static
    {
        $this->Codigo = $Codigo;

        return $this;
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

    public function getFechaIni(): ?\DateTimeInterface
    {
        return $this->Fecha_ini;
    }

    public function setFechaIni(\DateTimeInterface $Fecha_ini): static
    {
        $this->Fecha_ini = $Fecha_ini;

        return $this;
    }

    public function getFechaFin(): ?\DateTimeInterface
    {
        return $this->Fecha_fin;
    }

    public function setFechaFin(\DateTimeInterface $Fecha_fin): static
    {
        $this->Fecha_fin = $Fecha_fin;

        return $this;
    }

    /**
     * @return Collection<int, Convocatoria>
     */
    public function getConvocatorias(): Collection
    {
        return $this->convocatorias;
    }

    public function addConvocatoria(Convocatoria $convocatoria): static
    {
        if (!$this->convocatorias->contains($convocatoria)) {
            $this->convocatorias->add($convocatoria);
            $convocatoria->setProyecto($this);
        }

        return $this;
    }

    public function removeConvocatoria(Convocatoria $convocatoria): static
    {
        if ($this->convocatorias->removeElement($convocatoria)) {
            // set the owning side to null (unless already changed)
            if ($convocatoria->getProyecto() === $this) {
                $convocatoria->setProyecto(null);
            }
        }

        return $this;
    }
}
