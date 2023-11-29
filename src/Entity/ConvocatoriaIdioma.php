<?php

namespace App\Entity;

use App\Repository\ConvocatoriaIdiomaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConvocatoriaIdiomaRepository::class)]
class ConvocatoriaIdioma
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'convocatoriaIdiomas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Convocatoria $Convocatoria = null;

    #[ORM\ManyToOne(inversedBy: 'convocatoriaIdiomas')]
    #[ORM\JoinColumn(nullable: false)]
    private ?NivelIdioma $NivelIdioma = null;

    #[ORM\Column]
    private ?int $Puntuacion = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getNivelIdioma(): ?NivelIdioma
    {
        return $this->NivelIdioma;
    }

    public function setNivelIdioma(?NivelIdioma $NivelIdioma): static
    {
        $this->NivelIdioma = $NivelIdioma;

        return $this;
    }

    public function getPuntuacion(): ?int
    {
        return $this->Puntuacion;
    }

    public function setPuntuacion(int $Puntuacion): static
    {
        $this->Puntuacion = $Puntuacion;

        return $this;
    }
}
