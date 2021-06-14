<?php

namespace App\Entity;

use App\Repository\UsuarioPontosFavoritosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsuarioPontosFavoritosRepository::class)
 */
class UsuarioPontosFavoritos implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="PontosFavoritosMobile")
     * @ORM\JoinColumn(name="id_ponto_favorito", referencedColumnName="id", nullable=true)
     */
    private $ponto_favorito;

    /**
     * @ORM\ManyToOne(targetEntity="UserMobile")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", nullable=true)
     */
    private $usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPontoFavorito()
    {
        return $this->ponto_favorito;
    }

    public function setPontoFavorito($ponto_favorito): void
    {
        $this->ponto_favorito = $ponto_favorito;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }

    public function jsonSerialize()
    {
        return [
            'usuario' => $this->getUsuario(),
            'ponto_favorito' => $this->getPontoFavorito()
        ];
    }
}
