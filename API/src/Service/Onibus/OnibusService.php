<?php


namespace App\Service\Onibus;


use App\Repository\OnibusRepository;
use Doctrine\ORM\EntityManagerInterface;

class OnibusService
{
    private $em;

    private $onibusRepository;

    public function __construct(EntityManagerInterface $em, OnibusRepository $onibusRepository)
    {
        $this->em = $em;
        $this->onibusRepository = $onibusRepository;
    }

    public function listarOnibus(){

        $onibus = $this->onibusRepository->buscarTodosOnibus();
        return $onibus;
    }

}