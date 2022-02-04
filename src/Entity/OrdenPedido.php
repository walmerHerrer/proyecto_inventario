<?php

namespace Pidia\Apps\Demo\Entity;

namespace Pidia\Apps\Demo\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Pidia\Apps\Demo\Repository\OrdenPedidoRepository;
use Doctrine\ORM\Mapping as ORM;
use Pidia\Apps\Demo\Entity\Trabajador;
use Pidia\Apps\Demo\Entity\Almacen;
use Pidia\Apps\Demo\Entity\Producto;
use Pidia\Apps\Demo\Entity\Cliente;
use Pidia\Apps\Demo\Entity\Traits\EntityTrait;

use Symfony\Component\Validator\Constraints\Datetime;

#[ORM\Entity(repositoryClass: OrdenPedidoRepository::class)]
#[ORM\HasLifecycleCallbacks]
class OrdenPedido
{
    use EntityTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Almacen::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $almacen;

    #[ORM\ManyToOne(targetEntity: Trabajador::class)]
    private $trabajador;

    #[ORM\Column(type: 'datetime')]
    private $fechaPedido;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private $cantidadPedido;

    #[ORM\Column(type: 'decimal', precision: 10, scale: 2, nullable: true)]
    private $cantidadItems;

    #[ORM\ManyToMany(targetEntity: Producto::class)]
    private $productos;

    #[ORM\ManyToOne(targetEntity: Cliente::class)]
    private $cliente;

    public function __construct()
    {
        $this->detallePedidos = new ArrayCollection();
        $this->fechaPedido=new \DateTime();
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

    public function getFechaPedido(): ?\DateTimeInterface
    {
        return $this->fechaPedido;
    }

    public function setFechaPedido(\DateTimeInterface $fechaPedido): self
    {
        $this->fechaPedido = $fechaPedido;

        return $this;
    }

    public function getCantidadPedido(): ?string
    {
        return $this->cantidadPedido;
    }

    public function setCantidadPedido(?string $cantidadPedido): self
    {
        $this->cantidadPedido = $cantidadPedido;

        return $this;
    }

    public function getCantidadItems(): ?string
    {
        return $this->cantidadItems;
    }

    public function setCantidadItems(?string $cantidadItems): self
    {
        $this->cantidadItems = $cantidadItems;

        return $this;
    }

    /**
     * @return Collection|Productos[]
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProductos(Producto $productos): self
    {
        if (!$this->productos->contains($productos)) {
            $this->productos[] = $productos;
        }

        return $this;
    }

    public function removeProductos(Producto $productos): self
    {
        $this->productos->removeElement($productos);

        return $this;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }
}
