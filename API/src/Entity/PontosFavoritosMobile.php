<?php

namespace App\Entity;

use App\Repository\PontosFavoritosMobileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PontosFavoritosMobileRepository::class)
 */
class PontosFavoritosMobile implements \JsonSerializable
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
     * @ORM\OneToOne(targetEntity="Ponto")
     * @ORM\JoinColumn(name="id_ponto", referencedColumnName="id", nullable=true)
     */
    private $ponto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getPonto()
    {
        return $this->ponto;
    }

    public function setPonto($ponto): void
    {
        $this->ponto = $ponto;
    }

    public function jsonSerialize()
    {
        return [
            "id" => $this->getId(),
            "nome" => $this->getNome(),
            "ponto" => $this->getPonto()
        ];
    }
}
