<?php

namespace App\Entity;

use App\Repository\RotasOnibusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RotasOnibusRepository::class)
 * @ORM\Table(name="rota_onibus")
 */
class RotaOnibus implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Rota")
     * @ORM\JoinColumn(name="id_rota", referencedColumnName="id", onDelete="CASCADE")
     */
    private $rota;

    /**
     * @ORM\ManyToOne(targetEntity="Onibus")
     * @ORM\JoinColumn(name="id_onibus", referencedColumnName="id", onDelete="CASCADE")
     */
    private $onibus;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRota()
    {
        return $this->rota;
    }

    public function setRota($rota): self
    {
        $this->rota = $rota;
        return $this;
    }

    public function getOnibus()
    {
        return $this->onibus;
    }

    public function setOnibus($onibus): self
    {
        $this->onibus = $onibus;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "onibus" => $this->getOnibus(),
            "rota" => $this->getRota()
        ];
    }
}
