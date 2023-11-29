<?php

namespace App\Entity;

use App\Repository\BaremacionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BaremacionRepository::class)]
class Baremacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'baremacions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Candidato $Candidato = null;

    #[ORM\ManyToOne(inversedBy: 'baremacions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Convocatoria $Convocatoria = null;

    #[ORM\ManyToOne(inversedBy: 'baremacions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ItemBaremable $Item = null;

    #[ORM\Column]
    private ?int $Nota = null;

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

    public function getItem(): ?ItemBaremable
    {
        return $this->Item;
    }

    public function setItem(?ItemBaremable $Item): static
    {
        $this->Item = $Item;

        return $this;
    }

    public function getNota(): ?int
    {
        return $this->Nota;
    }

    public function setNota(int $Nota): static
    {
        $this->Nota = $Nota;

        return $this;
    }
}
