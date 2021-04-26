<?php

namespace App\Entity;

use App\Repository\AlunoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlunoRepository::class)
 */
class Aluno implements \JsonSerializable
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
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numero_contato;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ra;

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
    private $numero_casa;

    /**
     * @ORM\ManyToOne(targetEntity="Onibus")
     * @ORM\JoinColumn(name="id_onibus", referencedColumnName="id", nullable=true)
     */
    private $onibus;


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

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getNumeroContato()
    {
        return $this->numero_contato;
    }

    public function setNumeroContato($numero_contato): self
    {
        $this->numero_contato = $numero_contato;
        return $this;
    }

    public function getRa()
    {
        return $this->ra;
    }

    public function setRa($ra): self
    {
        $this->ra = $ra;
        return $this;
    }

    public function getBairro()
    {
        return $this->bairro;
    }

    public function setBairro($bairro): self
    {
        $this->bairro = $bairro;
        return $this;
    }

    public function getRua()
    {
        return $this->rua;
    }

    public function setRua($rua): self
    {
        $this->rua = $rua;
        return $this;
    }

    public function getNumeroCasa()
    {
        return $this->numero_casa;
    }

    public function setNumeroCasa($numero_casa): self
    {
        $this->numero_casa = $numero_casa;
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
           "id"                 => $this->getId(),
           "nome"               => $this->getNome(),
           "email"              => $this->getEmail(),
           "numero_contato"     => $this->getNumeroContato(),
           "ra"                 => $this->getRa(),
           "bairro"             => $this->getBairro(),
           "rua"                => $this->getRua(),
           "numero_casa"        => $this->getNumeroCasa(),
           "id_onibus"          => $this->getOnibus()
       ];
    }
}
