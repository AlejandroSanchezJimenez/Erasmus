<?php

namespace App\Entity;

use App\Repository\ConvocatoriaBaremablesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConvocatoriaBaremablesRepository::class)]
class ConvocatoriaBaremables
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'convocatoriaBaremables')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Convocatoria $Convocatoria = null;

    #[ORM\ManyToOne(inversedBy: 'convocatoriaBaremables')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ItemBaremable $Item = null;

    #[ORM\Column]
    private ?int $Maximo = null;

    #[ORM\Column]
    private ?bool $Requisito = null;

    #[ORM\Column(nullable: true)]
    private ?int $Minimo = null;

    #[ORM\Column]
    private ?bool $Aporta_Candidato = null;

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

    public function getItem(): ?ItemBaremable
    {
        return $this->Item;
    }

    public function setItem(?ItemBaremable $Item): static
    {
        $this->Item = $Item;

        return $this;
    }

    public function getMaximo(): ?int
    {
        return $this->Maximo;
    }

    public function setMaximo(int $Maximo): static
    {
        $this->Maximo = $Maximo;

        return $this;
    }

    public function isRequisito(): ?bool
    {
        return $this->Requisito;
    }

    public function setRequisito(bool $Requisito): static
    {
        $this->Requisito = $Requisito;

        return $this;
    }

    public function getMinimo(): ?int
    {
        return $this->Minimo;
    }

    public function setMinimo(?int $Minimo): static
    {
        $this->Minimo = $Minimo;

        return $this;
    }

    public function isAportaCandidato(): ?bool
    {
        return $this->Aporta_Candidato;
    }

    public function setAportaCandidato(bool $Aporta_Candidato): static
    {
        $this->Aporta_Candidato = $Aporta_Candidato;

        return $this;
    }
}
