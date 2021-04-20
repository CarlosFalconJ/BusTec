<?php


namespace App\Service\Rota;


use App\Repository\RotaRepository;
use Doctrine\ORM\EntityManagerInterface;

class RotaService
{
    private $em;

    private $rotaRepository;

    public function __construct(EntityManagerInterface $em, RotaRepository $rotaRepository)
    {
        $this->em = $em;
        $this->rotaRepository = $rotaRepository;
    }

    public function listarRotas(){

        $rotas = $this->rotaRepository->buscarTodasRotas();
        return $rotas;
    }
}