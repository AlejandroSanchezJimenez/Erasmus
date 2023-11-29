<?php

namespace App\Entity;

use App\Repository\ItemBaremableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemBaremableRepository::class)]
class ItemBaremable
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $Nombre = null;

    #[ORM\OneToMany(mappedBy: 'Item', targetEntity: ConvocatoriaBaremables::class, orphanRemoval: true)]
    private Collection $convocatoriaBaremables;

    #[ORM\OneToMany(mappedBy: 'Item', targetEntity: Baremacion::class, orphanRemoval: true)]
    private Collection $baremacions;

    public function __construct()
    {
        $this->convocatoriaBaremables = new ArrayCollection();
        $this->baremacions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
            $convocatoriaBaremable->setItem($this);
        }

        return $this;
    }

    public function removeConvocatoriaBaremable(ConvocatoriaBaremables $convocatoriaBaremable): static
    {
        if ($this->convocatoriaBaremables->removeElement($convocatoriaBaremable)) {
            // set the owning side to null (unless already changed)
            if ($convocatoriaBaremable->getItem() === $this) {
                $convocatoriaBaremable->setItem(null);
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
            $baremacion->setItem($this);
        }

        return $this;
    }

    public function removeBaremacion(Baremacion $baremacion): static
    {
        if ($this->baremacions->removeElement($baremacion)) {
            // set the owning side to null (unless already changed)
            if ($baremacion->getItem() === $this) {
                $baremacion->setItem(null);
            }
        }

        return $this;
    }
}
