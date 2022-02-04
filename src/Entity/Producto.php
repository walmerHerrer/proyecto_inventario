<?php

namespace Pidia\Apps\Demo\Entity;

use Pidia\Apps\Demo\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;
use Pidia\Apps\Demo\Entity\Traits\EntityTrait;
use Pidia\Apps\Demo\Entity\Categoria;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Producto
{
    use EntityTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Categoria::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $categoria;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $precio_unitario;

    #[ORM\Column(type: 'string', length: 80, nullable: true)]
    private $descripcion;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2)]
    private $PrecioVenta;

    #[ORM\Column(type: 'string', length: 50)]
    private $nombre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getPrecioUnitario(): ?string
    {
        return $this->precio_unitario;
    }

    public function setPrecioUnitario(string $precio_unitario): self
    {
        $this->precio_unitario = $precio_unitario;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): self
    {
        $this->descripcion = $descripcion;

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
    public function __ToString():string{  
        return $this->getNombre() ;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }
}
