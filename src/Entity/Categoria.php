<?php

namespace Pidia\Apps\Demo\Entity;

use Pidia\Apps\Demo\Repository\CategoriaRepository;
use Doctrine\ORM\Mapping as ORM;
use Pidia\Apps\Demo\Entity\Traits\EntityTrait;

#[ORM\Entity(repositoryClass: CategoriaRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Categoria
{
    use EntityTrait;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 80, nullable: true)]
    private $detalle;

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

    public function getDetalle(): ?string
    {
        return $this->detalle;
    }

    public function setDetalle(?string $detalle): self
    {
        $this->detalle = $detalle;

        return $this;
    }
    public function __ToString():string{  
        return $this->getNombre() ;
    }
}
