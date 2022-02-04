<?php

namespace Pidia\Apps\Demo\Entity;

use Pidia\Apps\Demo\Repository\DetalleOrdenCompraRepository;
use Doctrine\ORM\Mapping as ORM;
use Pidia\Apps\Demo\Entity\Traits\EntityTrait;
use Pidia\Apps\Demo\Entity\Producto;

#[ORM\Entity(repositoryClass: DetalleOrdenCompraRepository::class)]
#[ORM\HasLifecycleCallbacks]
class DetalleOrdenCompra
{
    use EntityTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Producto::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $producto;

    #[ORM\ManyToOne(targetEntity: OrdenCompra::class, inversedBy: 'detalles')]
    #[ORM\JoinColumn(nullable: false)]
    private $ordenCompra;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private $precioProveedor;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $cantRecibida;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducto(): ?Producto
    {
        return $this->producto;
    }

    public function setProducto(?Producto $producto): self
    {
        $this->producto = $producto;

        return $this;
    }

    public function getOrdenCompra(): ?OrdenCompra
    {
        return $this->ordenCompra;
    }

    public function setOrdenCompra(?OrdenCompra $ordenCompra): self
    {
        $this->ordenCompra = $ordenCompra;

        return $this;
    }

    public function getPrecioProveedor(): ?string
    {
        return $this->precioProveedor;
    }

    public function setPrecioProveedor(?string $precioProveedor): self
    {
        $this->precioProveedor = $precioProveedor;

        return $this;
    }

    public function getCantRecibida(): ?string
    {
        return $this->cantRecibida;
    }

    public function setCantRecibida(string $cantRecibida): self
    {
        $this->cantRecibida = $cantRecibida;

        return $this;
    }
}
