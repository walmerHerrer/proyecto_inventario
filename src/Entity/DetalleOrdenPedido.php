<?php

namespace Pidia\Apps\Demo\Entity;

use Pidia\Apps\Demo\Repository\DetalleOrdenPedidoRepository;
use Doctrine\ORM\Mapping as ORM;
use Pidia\Apps\Demo\Entity\Producto;
use Pidia\Apps\Demo\Entity\Traits\EntityTrait;

#[ORM\Entity(repositoryClass: DetalleOrdenPedidoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class DetalleOrdenPedido
{
    use EntityTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Producto::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $producto;

    #[ORM\ManyToOne(targetEntity: OrdenPedido::class, inversedBy: 'detalles')]
    #[ORM\JoinColumn(nullable: false)]
    private $ordenPedido;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $PrecioVenta;

    #[ORM\Column(type: 'integer')]
    private $cantidad;


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
    public function getOrdenPedido(): ?OrdenPedido
    {
        return $this->ordenPedido;
    }

    public function setOrdenPedido(?OrdenPedido $ordenPedido): self
    {
        $this->ordenPedido = $ordenPedido;

        return $this;
    }

    public function getPrecioVenta(): ?string
    {
        return $this->PrecioVenta;
    }

    public function setPrecioVenta(string $PrecioVenta): self
    {
        $this->PrecioVenta = $PrecioVenta;

        return $this;
    }

    public function getCantidad(): ?int
    {
        return $this->cantidad;
    }

    public function setCantidad(int $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    
}
