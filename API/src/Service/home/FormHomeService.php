<?php


namespace App\Service\home;


use App\Repository\OnibusRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Repository\RepositoryFactory;

class FormHomeService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buscaTotalOnibus($repository)
    {
        $todosOnibus = $repository->buscarTotalOnibus();
        return $todosOnibus;
    }

    public function buscaTotalAlunos($repository)
    {
        $todosAlunos = $repository->buscaTotalAlunos();
        return $todosAlunos;
    }

    public function buscaTotalRotas($repository)
    {
        $todasRotas = $repository->buscaTotalRotas();
        return $todasRotas;
    }

    public function buscaTotalPontos($repository)
    {
        $todosPontos = $repository->buscaTotalPontos();
        return $todosPontos;
    }
}