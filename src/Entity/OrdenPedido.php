<?php

namespace Pidia\Apps\Demo\Entity;

namespace Pidia\Apps\Demo\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Pidia\Apps\Demo\Repository\OrdenPedidoRepository;
use Doctrine\ORM\Mapping as ORM;
use Pidia\Apps\Demo\Entity\Trabajador;
use Pidia\Apps\Demo\Entity\Almacen;
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

    #[ORM\ManyToOne(targetEntity: Cliente::class)]
    private $cliente;
    
    #[ORM\OneToMany(mappedBy: 'ordenPedido', targetEntity: DetalleOrdenPedido::class,cascade: ['persist','remove'], orphanRemoval: true)]
    private $detalles;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $despacho=0;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaDespacho;
    

    public function __construct()
    {
        $this->detalles = new ArrayCollection();
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

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }
    
    /**
     * @return Collection|DetalleOrdenPedido[]
     */
    public function getDetalles(): Collection
    {
        return $this->detalles;
    }

    public function addDetalle(DetalleOrdenPedido $detalle): self
    {
        if (!$this->detalles->contains($detalle)) {
            $this->detalles[] = $detalle;
            $detalle->setOrdenPedido($this);
        }

        return $this;
    }

    public function removeDetalle(DetalleOrdenPedido $detalle): self
    {
        if ($this->detalles->removeElement($detalle)) {
            // set the owning side to null (unless already changed)
            if ($detalle->getOrdenPedido() === $this) {
                $detalle->setOrdenPedido(null);
            }
        }

        return $this;
    }

    public function getDespacho(): ?bool
    {
        return $this->despacho;
    }

    public function setDespacho(?bool $despacho): self
    {
        $this->despacho = $despacho;

        return $this;
    }

    public function getFechaDespacho(): ?\DateTimeInterface
    {
        return $this->fechaDespacho;
    }

    public function setFechaDespacho(?\DateTimeInterface $fechaDespacho): self
    {
        $this->fechaDespacho = $fechaDespacho;

        return $this;
    }
}
