<?php

namespace App\Entity;

use App\Repository\TutorLegalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TutorLegalRepository::class)]
class TutorLegal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Apellidos = null;

    #[ORM\Column(length: 100)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 9)]
    private ?string $DNI = null;

    #[ORM\Column(length: 300)]
    private ?string $Domicilio = null;

    #[ORM\Column(length: 9)]
    private ?string $Tlf = null;

    #[ORM\OneToMany(mappedBy: 'Tutor', targetEntity: Candidato::class)]
    private Collection $candidatos;

    public function __construct()
    {
        $this->candidatos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDNI(): ?string
    {
        return $this->DNI;
    }

    public function setDNI(string $DNI): static
    {
        $this->DNI = $DNI;

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

    public function getTlf(): ?string
    {
        return $this->Tlf;
    }

    public function setTlf(string $Tlf): static
    {
        $this->Tlf = $Tlf;

        return $this;
    }

    /**
     * @return Collection<int, Candidato>
     */
    public function getCandidatos(): Collection
    {
        return $this->candidatos;
    }

    public function addCandidato(Candidato $candidato): static
    {
        if (!$this->candidatos->contains($candidato)) {
            $this->candidatos->add($candidato);
            $candidato->setTutor($this);
        }

        return $this;
    }

    public function removeCandidato(Candidato $candidato): static
    {
        if ($this->candidatos->removeElement($candidato)) {
            // set the owning side to null (unless already changed)
            if ($candidato->getTutor() === $this) {
                $candidato->setTutor(null);
            }
        }

        return $this;
    }
}
