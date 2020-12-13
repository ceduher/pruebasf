<?php

namespace App\Entity;

use App\Repository\ArticuloRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticuloRepository::class)
 */
class Articulo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $talla;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $color;

    /**
     * @ORM\Column(type="float")
     */
    private $precio_uni;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTalla(): ?string
    {
        return $this->talla;
    }

    public function setTalla(string $talla): self
    {
        $this->talla = $talla;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getPrecioUni(): ?float
    {
        return $this->precio_uni;
    }

    public function setPrecioUni(float $precio_uni): self
    {
        $this->precio_uni = $precio_uni;

        return $this;
    }
}
