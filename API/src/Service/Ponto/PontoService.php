<?php


namespace App\Service\Ponto;


use App\Repository\PontoRepository;
use Doctrine\ORM\EntityManagerInterface;

class PontoService
{
    private $em;

    private $pontoRepository;

    public function __construct(EntityManagerInterface $em, PontoRepository $pontoRepository)
    {
        $this->em = $em;
        $this->pontoRepository = $pontoRepository;
    }

    public function listarRotas(){

        $pontos = $this->pontoRepository->buscarTodosPontos();
        return $pontos;
    }
}