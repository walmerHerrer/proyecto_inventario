<?php

namespace Pidia\Apps\Demo\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Pidia\Apps\Demo\Repository\OrdenCompraRepository;
use Doctrine\ORM\Mapping as ORM;
use Pidia\Apps\Demo\Entity\Trabajador;
use Pidia\Apps\Demo\Entity\Proveedor;
use Pidia\Apps\Demo\Entity\Almacen;
use Pidia\Apps\Demo\Entity\Traits\EntityTrait;

use Symfony\Component\Validator\Constraints\Datetime;

#[ORM\Entity(repositoryClass: OrdenCompraRepository::class)]
#[ORM\HasLifecycleCallbacks]
class OrdenCompra
{
    use EntityTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Trabajador::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $trabajador;

    #[ORM\ManyToOne(targetEntity: Proveedor::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $proveedor;

    #[ORM\Column(type: 'datetime')]
    private $fecha;
    
    #[ORM\OneToMany(mappedBy: 'ordenCompra', targetEntity: DetalleOrdenCompra::class,cascade: ['persist','remove'], orphanRemoval: true)]
    private $detalles;

    #[ORM\Column(type: 'string', length: 10, nullable: true)]
    private $numFactura;

    #[ORM\ManyToOne(targetEntity: Almacen::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $almacen;
    

    public function __construct()
    {
        $this->detalles = new ArrayCollection();
        $this->fecha=new \DateTime();

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

    public function getProveedor(): ?Proveedor
    {
        return $this->proveedor;
    }

    public function setProveedor(?Proveedor $proveedor): self
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }


    /**
     * @return Collection|DetalleOrdenCompra[]
     */
    public function getDetalles(): Collection
    {
        return $this->detalles;
    }

    public function addDetalle(DetalleOrdenCompra $detalle): self
    {
        if (!$this->detalles->contains($detalle)) {
            $this->detalles[] = $detalle;
            $detalle->setOrdenCompra($this);
        }

        return $this;
    }

    public function removeDetalle(DetalleOrdenCompra $detalle): self
    {
        if ($this->detalles->removeElement($detalle)) {
            // set the owning side to null (unless already changed)
            if ($detalle->getOrdenCompra() === $this) {
                $detalle->setOrdenCompra(null);
            }
        }

        return $this;
    }
    public function getNumFactura(): ?string
    {
        return $this->numFactura;
    }

    public function setNumFactura(?string $numFactura): self
    {
        $this->numFactura = $numFactura;

        return $this;
    }
}
