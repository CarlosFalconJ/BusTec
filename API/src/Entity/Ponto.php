<?php

namespace App\Entity;

use App\Repository\PontoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PontoRepository::class)
 */
class Ponto implements \JsonSerializable
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
    private $nome;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $bairro;

     /**
     * @ORM\Column(type="string", length=255)
     */
    private $rua;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ponto_referencia;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro): void
    {
        $this->bairro = $bairro;
    }

    public function getRua()
    {
        return $this->rua;
    }

    public function setRua($rua): void
    {
        $this->rua = $rua;
    }

    public function getPontoReferencia()
    {
        return $this->ponto_referencia;
    }

    public function setPontoReferencia($ponto_referencia): void
    {
        $this->ponto_referencia = $ponto_referencia;
    }

    public function jsonSerialize()
    {
       return [
           "nome" => $this->getNome(),
           "bairro" => $this->getBairro(),
           "rua" => $this->getRua(),
           "ponto_referencia" => $this->getPontoReferencia()
       ];
    }
}
