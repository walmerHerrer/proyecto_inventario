<?php

namespace Pidia\Apps\Demo\Entity;

use Pidia\Apps\Demo\Repository\AlmacenRepository;
use Doctrine\ORM\Mapping as ORM;
use Pidia\Apps\Demo\Entity\Traits\EntityTrait;

#[ORM\Entity(repositoryClass: AlmacenRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Almacen
{
    use EntityTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    private $telefono;

    #[ORM\Column(type: 'string', length: 80, nullable: true)]
    private $direccion;

    #[ORM\Column(type: 'string', length: 11, nullable: true)]
    private $ruc;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    public function getRuc(): ?string
    {
        return $this->ruc;
    }

    public function setRuc(?string $ruc): self
    {
        $this->ruc = $ruc;

        return $this;
    }
    public function __ToString():string{  
        return $this->getNombre();
    }

}
