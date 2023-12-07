<?php

namespace App\Entity;

use App\Repository\ConvocatoriaDestinatarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConvocatoriaDestinatarioRepository::class)]
class ConvocatoriaDestinatario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'convocatoriaDestinatarios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Convocatoria $Convocatoria = null;

    #[ORM\ManyToOne(inversedBy: 'convocatoriaDestinatarios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Destinatario $Destinatario = null;

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

    public function getDestinatario(): ?Destinatario
    {
        return $this->Destinatario;
    }

    public function setDestinatario(?Destinatario $Destinatario): static
    {
        $this->Destinatario = $Destinatario;

        return $this;
    }
}
