<?php

namespace App\Entity;

use App\Repository\ConvocatoriaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConvocatoriaRepository::class)]
class Convocatoria
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $Movilidades = null;

    #[ORM\Column(length: 10)]
    private ?string $Tipo = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Fecha_ini = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Fecha_fin = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Fecha_ini_pruebas = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Fecha_fin_pruebas = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Fecha_lista_prov = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Fecha_lista_final = null;

    #[ORM\ManyToOne(inversedBy: 'convocatorias')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Proyecto $Proyecto = null;

    #[ORM\OneToMany(mappedBy: 'Convocatoria', targetEntity: ConvocatoriaBaremables::class, orphanRemoval: true)]
    private Collection $convocatoriaBaremables;

    #[ORM\OneToMany(mappedBy: 'Convocatoria', targetEntity: ConvocatoriaIdioma::class, orphanRemoval: true)]
    private Collection $convocatoriaIdiomas;

    #[ORM\OneToMany(mappedBy: 'Convocatoria', targetEntity: Solicitud::class, orphanRemoval: true)]
    private Collection $solicituds;

    #[ORM\OneToMany(mappedBy: 'Convocatoria', targetEntity: Baremacion::class, orphanRemoval: true)]
    private Collection $baremacions;

    public function __construct()
    {
        $this->convocatoriaBaremables = new ArrayCollection();
        $this->convocatoriaIdiomas = new ArrayCollection();
        $this->solicituds = new ArrayCollection();
        $this->baremacions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovilidades(): ?int
    {
        return $this->Movilidades;
    }

    public function setMovilidades(int $Movilidades): static
    {
        $this->Movilidades = $Movilidades;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->Tipo;
    }

    public function setTipo(string $Tipo): static
    {
        $this->Tipo = $Tipo;

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

    public function getFechaIniPruebas(): ?\DateTimeInterface
    {
        return $this->Fecha_ini_pruebas;
    }

    public function setFechaIniPruebas(\DateTimeInterface $Fecha_ini_pruebas): static
    {
        $this->Fecha_ini_pruebas = $Fecha_ini_pruebas;

        return $this;
    }

    public function getFechaFinPruebas(): ?\DateTimeInterface
    {
        return $this->Fecha_fin_pruebas;
    }

    public function setFechaFinPruebas(\DateTimeInterface $Fecha_fin_pruebas): static
    {
        $this->Fecha_fin_pruebas = $Fecha_fin_pruebas;

        return $this;
    }

    public function getFechaListaProv(): ?\DateTimeInterface
    {
        return $this->Fecha_lista_prov;
    }

    public function setFechaListaProv(\DateTimeInterface $Fecha_lista_prov): static
    {
        $this->Fecha_lista_prov = $Fecha_lista_prov;

        return $this;
    }

    public function getFechaListaFinal(): ?\DateTimeInterface
    {
        return $this->Fecha_lista_final;
    }

    public function setFechaListaFinal(\DateTimeInterface $Fecha_lista_final): static
    {
        $this->Fecha_lista_final = $Fecha_lista_final;

        return $this;
    }

    public function getProyecto(): ?Proyecto
    {
        return $this->Proyecto;
    }

    public function setProyecto(?Proyecto $Proyecto): static
    {
        $this->Proyecto = $Proyecto;

        return $this;
    }

    /**
     * @return Collection<int, ConvocatoriaBaremables>
     */
    public function getConvocatoriaBaremables(): Collection
    {
        return $this->convocatoriaBaremables;
    }

    public function addConvocatoriaBaremable(ConvocatoriaBaremables $convocatoriaBaremable): static
    {
        if (!$this->convocatoriaBaremables->contains($convocatoriaBaremable)) {
            $this->convocatoriaBaremables->add($convocatoriaBaremable);
            $convocatoriaBaremable->setConvocatoria($this);
        }

        return $this;
    }

    public function removeConvocatoriaBaremable(ConvocatoriaBaremables $convocatoriaBaremable): static
    {
        if ($this->convocatoriaBaremables->removeElement($convocatoriaBaremable)) {
            // set the owning side to null (unless already changed)
            if ($convocatoriaBaremable->getConvocatoria() === $this) {
                $convocatoriaBaremable->setConvocatoria(null);
            }
        }

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
            $convocatoriaIdioma->setConvocatoria($this);
        }

        return $this;
    }

    public function removeConvocatoriaIdioma(ConvocatoriaIdioma $convocatoriaIdioma): static
    {
        if ($this->convocatoriaIdiomas->removeElement($convocatoriaIdioma)) {
            // set the owning side to null (unless already changed)
            if ($convocatoriaIdioma->getConvocatoria() === $this) {
                $convocatoriaIdioma->setConvocatoria(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Solicitud>
     */
    public function getSolicituds(): Collection
    {
        return $this->solicituds;
    }

    public function addSolicitud(Solicitud $solicitud): static
    {
        if (!$this->solicituds->contains($solicitud)) {
            $this->solicituds->add($solicitud);
            $solicitud->setConvocatoria($this);
        }

        return $this;
    }

    public function removeSolicitud(Solicitud $solicitud): static
    {
        if ($this->solicituds->removeElement($solicitud)) {
            // set the owning side to null (unless already changed)
            if ($solicitud->getConvocatoria() === $this) {
                $solicitud->setConvocatoria(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Baremacion>
     */
    public function getBaremacions(): Collection
    {
        return $this->baremacions;
    }

    public function addBaremacion(Baremacion $baremacion): static
    {
        if (!$this->baremacions->contains($baremacion)) {
            $this->baremacions->add($baremacion);
            $baremacion->setConvocatoria($this);
        }

        return $this;
    }

    public function removeBaremacion(Baremacion $baremacion): static
    {
        if ($this->baremacions->removeElement($baremacion)) {
            // set the owning side to null (unless already changed)
            if ($baremacion->getConvocatoria() === $this) {
                $baremacion->setConvocatoria(null);
            }
        }

        return $this;
    }
}
