<?php

namespace App\Entity;

use App\Repository\RotasOnibusRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RotasOnibusRepository::class)
 * @ORM\Table(name="rota_onibus")
 */
class RotaOnibus
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Rota")
     * @ORM\JoinColumn(name="id_rota", referencedColumnName="id")
     */
    private $rota;

    /**
     * @ORM\ManyToOne(targetEntity="Onibus")
     * @ORM\JoinColumn(name="id_onibus", referencedColumnName="id")
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
}
