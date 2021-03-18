<?php

namespace App\Entity;

use App\Repository\RotaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RotaRepository::class)
 */
class Rota implements \JsonSerializable
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
    private $cidade;


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

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade): void
    {
        $this->cidade = $cidade;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function setHorario($horario): void
    {
        $this->horario = $horario;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "nome" => $this->getNome(),
            "cidade" => $this->getCidade()
        ];
    }


}
