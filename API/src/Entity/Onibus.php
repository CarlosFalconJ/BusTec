<?php

namespace App\Entity;

use App\Repository\OnibusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OnibusRepository::class)
 */
class Onibus implements \JsonSerializable
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
    private $placa;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $motorista_responsavel;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlaca(): ?string
    {
        return $this->placa;
    }

    public function setPlaca(string $placa): self
    {
        $this->placa = $placa;

        return $this;
    }

    public function getMotoristaResponsavel()
    {
        return $this->motorista_responsavel;
    }

    public function setMotoristaResponsavel($motorista_responsavel): void
    {
        $this->motorista_responsavel = $motorista_responsavel;
    }

    public function jsonSerialize()
    {
        return [
            "placa" => $this->getPlaca(),
            "motorista_responsavel" =>$this->getMotoristaResponsavel()
        ];
    }
}
