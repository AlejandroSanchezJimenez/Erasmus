<?php

namespace App\Entity;

use App\Repository\SolicitudRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SolicitudRepository::class)]
class Solicitud
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'solicituds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Candidato $Candidato = null;

    #[ORM\ManyToOne(inversedBy: 'solicituds')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Convocatoria $Convocatoria = null;

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

    #[ORM\Column(length: 10)]
    private ?string $id_tutor = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $urlNotas = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $urlIdioma = null;

    #[ORM\Column(length: 100)]
    private ?string $FotoDNI = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCandidato(): ?Candidato
    {
        return $this->Candidato;
    }

    public function setCandidato(?Candidato $Candidato): static
    {
        $this->Candidato = $Candidato;

        return $this;
    }

    public function getConvocatoria(): ?Convocatoria
    {
        return $this->Convocatoria;
    }

    public function setConvocatoria(?Convocatoria $Convocatoria): static
    {
        $this->Convocatoria = $Convocatoria;

        return $this;
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

    public function getIdTutor(): ?string
    {
        return $this->id_tutor;
    }

    public function setIdTutor(string $id_tutor): static
    {
        $this->id_tutor = $id_tutor;

        return $this;
    }

    public function getUrlNotas(): ?string
    {
        return $this->urlNotas;
    }

    public function setUrlNotas(?string $urlNotas): static
    {
        $this->urlNotas = $urlNotas;

        return $this;
    }

    public function getUrlIdioma(): ?string
    {
        return $this->urlIdioma;
    }

    public function setUrlIdioma(?string $urlIdioma): static
    {
        $this->urlIdioma = $urlIdioma;

        return $this;
    }

    public function getFotoDNI(): ?string
    {
        return $this->FotoDNI;
    }

    public function setFotoDNI(string $FotoDNI): static
    {
        $this->FotoDNI = $FotoDNI;

        return $this;
    }
}
