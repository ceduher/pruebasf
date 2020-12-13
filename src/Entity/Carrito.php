<?php

namespace App\Entity;

use App\Repository\CarritoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CarritoRepository::class)
 */
class Carrito
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $usuario;

    /**
     * @ORM\Column(type="json")
     */
    private $renglones = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?int
    {
        return $this->usuario;
    }

    public function setUsuario(int $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getRenglones(): ?array
    {
        return $this->renglones;
    }

    public function setRenglones(array $renglones): self
    {
        $this->renglones = $renglones;

        return $this;
    }

}
