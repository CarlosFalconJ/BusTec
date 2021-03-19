<?php

namespace App\Entity;

use App\Repository\RotaPontoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RotaPontoRepository::class)
 * @ORM\Table(name="rota_ponto")
 */
class RotaPonto
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
     * @ORM\ManyToOne(targetEntity="Ponto")
     * @ORM\JoinColumn(name="id_ponto", referencedColumnName="id")
     */
    private $ponto;


    /**
     * @var datetime
     * @ORM\Column(type="datetime")
     */
    private $horario;



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

    public function getPonto()
    {
        return $this->ponto;
    }

    public function setPonto($ponto): self
    {
        $this->ponto = $ponto;
        return $this;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function setHorario($horario): void
    {
        $this->horario = $horario;
    }
}
