<?php

namespace Pidia\Apps\Demo\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Pidia\Apps\Demo\Repository\DespachoRepository;
use Doctrine\ORM\Mapping as ORM;
use Pidia\Apps\Demo\Entity\Producto;
use Pidia\Apps\Demo\Entity\Almacen;
use Pidia\Apps\Demo\Entity\Traits\EntityTrait;
use Pidia\Apps\Demo\Entity\Trabajador;

#[ORM\Entity(repositoryClass: DespachoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Despacho
{
    use EntityTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Almacen::class)]
    private $almacen;

    #[ORM\ManyToOne(targetEntity: Trabajador::class)]
    private $trabajador;

    #[ORM\Column(type: 'datetime')]
    private $fechaSalida;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private $itemsDesapachados;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private $cantidadDespacho;

    #[ORM\ManyToMany(targetEntity: Producto::class)]
    private $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlmacen(): ?Almacen
    {
        return $this->almacen;
    }

    public function setAlmacen(?Almacen $almacen): self
    {
        $this->almacen = $almacen;

        return $this;
    }

    public function getTrabajador(): ?Trabajador
    {
        return $this->trabajador;
    }

    public function setTrabajador(?Trabajador $trabajador): self
    {
        $this->trabajador = $trabajador;

        return $this;
    }

    public function getFechaSalida(): ?\DateTimeInterface
    {
        return $this->fechaSalida;
    }

    public function setFechaSalida(\DateTimeInterface $fechaSalida): self
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    public function getItemsDesapachados(): ?string
    {
        return $this->itemsDesapachados;
    }

    public function setItemsDesapachados(?string $itemsDesapachados): self
    {
        $this->itemsDesapachados = $itemsDesapachados;

        return $this;
    }

    public function getCantidadDespacho(): ?string
    {
        return $this->cantidadDespacho;
    }

    public function setCantidadDespacho(?string $cantidadDespacho): self
    {
        $this->cantidadDespacho = $cantidadDespacho;

        return $this;
    }

    /**
     * @return Collection|Producto[]
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Producto $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        $this->productos->removeElement($producto);

        return $this;
    }
}
