<?php

namespace App\Entity;

use App\Repository\DestinatarioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(mappedBy: 'Destinatario', targetEntity: ConvocatoriaDestinatario::class, orphanRemoval: true)]
    private Collection $convocatoriaDestinatarios;

    public function __construct()
    {
        $this->convocatoriaDestinatarios = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, ConvocatoriaDestinatario>
     */
    public function getConvocatoriaDestinatarios(): Collection
    {
        return $this->convocatoriaDestinatarios;
    }

    public function addConvocatoriaDestinatario(ConvocatoriaDestinatario $convocatoriaDestinatario): static
    {
        if (!$this->convocatoriaDestinatarios->contains($convocatoriaDestinatario)) {
            $this->convocatoriaDestinatarios->add($convocatoriaDestinatario);
            $convocatoriaDestinatario->setDestinatario($this);
        }

        return $this;
    }

    public function removeConvocatoriaDestinatario(ConvocatoriaDestinatario $convocatoriaDestinatario): static
    {
        if ($this->convocatoriaDestinatarios->removeElement($convocatoriaDestinatario)) {
            // set the owning side to null (unless already changed)
            if ($convocatoriaDestinatario->getDestinatario() === $this) {
                $convocatoriaDestinatario->setDestinatario(null);
            }
        }

        return $this;
    }
}
