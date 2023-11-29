<?php

namespace App\Entity;

use App\Repository\DestinatarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DestinatarioRepository::class)]
class Destinatario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $CodGrupo = null;

    #[ORM\Column(length: 100)]
    private ?string $Nombre = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodGrupo(): ?string
    {
        return $this->CodGrupo;
    }

    public function setCodGrupo(string $CodGrupo): static
    {
        $this->CodGrupo = $CodGrupo;

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
}
