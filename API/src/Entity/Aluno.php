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

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function getNumeroContato()
    {
        return $this->numero_contato;
    }

    public function setNumeroContato($numero_contato): void
    {
        $this->numero_contato = $numero_contato;
    }

    public function getRa()
    {
        return $this->ra;
    }

    public function setRa($ra): void
    {
        $this->ra = $ra;
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

    public function getNumeroCasa()
    {
        return $this->numero_casa;
    }

    public function setNumeroCasa($numero_casa): void
    {
        $this->numero_casa = $numero_casa;
    }

    public function jsonSerialize()
    {
       return [
           "nome" => $this->getNome(),
           "email" => $this->getEmail(),
           "numero_contato" => $this->getNumeroContato(),
           "ra" => $this->getRa(),
           "bairro" => $this->getBairro(),
           "rua" => $this->getRua(),
           "numero_casa" => $this->getNumeroCasa()
       ];
    }
}
