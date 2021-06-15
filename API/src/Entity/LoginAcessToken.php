<?php

namespace App\Entity;

use App\Repository\LoginAcessTokenRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LoginAcessTokenRepository::class)
 */
class LoginAcessToken implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type = "string")
     */
    private $token;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function setToken($token): void
    {
        $this->token = $token;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): void
    {
        $this->user = $user;
    }

    public function jsonSerialize()
    {
        return [
            "token" => $this->getToken(),
            "user" => $this->getUser(),
        ];
    }
}
