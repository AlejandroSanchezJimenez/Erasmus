<?php

namespace App\Entity;

use App\Repository\CandidatoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CandidatoRepository::class)]
class Candidato
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 9)]
    private ?string $DNI = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $Fecha_nac = null;

    #[ORM\Column(length: 100)]
    private ?string $Apellidos = null;

    #[ORM\Column(length: 100)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 10)]
    private ?string $Curso = null;

    #[ORM\Column(length: 9)]
    private ?string $Tlf = null;

    #[ORM\Column(length: 100)]
    private ?string $Correo = null;

    #[ORM\Column(length: 300)]
    private ?string $Domicilio = null;

    #[ORM\ManyToOne(inversedBy: 'candidatos')]
    private ?TutorLegal $Tutor = null;

    #[ORM\OneToMany(mappedBy: 'Candidato', targetEntity: Solicitud::class, orphanRemoval: true)]
    private Collection $solicituds;

    #[ORM\OneToMany(mappedBy: 'Candidato', targetEntity: Baremacion::class, orphanRemoval: true)]
    private Collection $baremacions;

    public function __construct()
    {
        $this->solicituds = new ArrayCollection();
        $this->baremacions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDNI(): ?string
    {
        return $this->DNI;
    }

    public function setDNI(string $DNI): static
    {
        $this->DNI = $DNI;

        return $this;
    }

    public function getFechaNac(): ?\DateTimeInterface
    {
        return $this->Fecha_nac;
    }

    public function setFechaNac(\DateTimeInterface $Fecha_nac): static
    {
        $this->Fecha_nac = $Fecha_nac;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->Apellidos;
    }

    public function setApellidos(string $Apellidos): static
    {
        $this->Apellidos = $Apellidos;

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

    public function getCurso(): ?string
    {
        return $this->Curso;
    }

    public function setCurso(string $Curso): static
    {
        $this->Curso = $Curso;

        return $this;
    }

    public function getTlf(): ?string
    {
        return $this->Tlf;
    }

    public function setTlf(string $Tlf): static
    {
        $this->Tlf = $Tlf;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->Correo;
    }

    public function setCorreo(string $Correo): static
    {
        $this->Correo = $Correo;

        return $this;
    }

    public function getDomicilio(): ?string
    {
        return $this->Domicilio;
    }

    public function setDomicilio(string $Domicilio): static
    {
        $this->Domicilio = $Domicilio;

        return $this;
    }

    public function getTutor(): ?TutorLegal
    {
        return $this->Tutor;
    }

    public function setTutor(?TutorLegal $Tutor): static
    {
        $this->Tutor = $Tutor;

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
            $solicitud->setCandidato($this);
        }

        return $this;
    }

    public function removeSolicitud(Solicitud $solicitud): static
    {
        if ($this->solicituds->removeElement($solicitud)) {
            // set the owning side to null (unless already changed)
            if ($solicitud->getCandidato() === $this) {
                $solicitud->setCandidato(null);
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
            $baremacion->setCandidato($this);
        }

        return $this;
    }

    public function removeBaremacion(Baremacion $baremacion): static
    {
        if ($this->baremacions->removeElement($baremacion)) {
            // set the owning side to null (unless already changed)
            if ($baremacion->getCandidato() === $this) {
                $baremacion->setCandidato(null);
            }
        }

        return $this;
    }
}
