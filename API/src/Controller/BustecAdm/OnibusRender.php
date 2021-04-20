<?php


namespace App\Controller\BustecAdm;


use App\Repository\OnibusRepository;
use App\Service\Onibus\OnibusService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OnibusRender extends AbstractController
{
    private $em;

    private $onibusRepository;

    public function __construct(EntityManagerInterface $em, OnibusRepository $onibusRepository)
    {

        $this->em = $em;
        $this->onibusRepository = $onibusRepository;
    }

    public function cadastroOnibus()
    {
        return $this->render('Onibus\cadastro_onibus.html.twig');
    }

    public function atualizarOnibus()
    {
        return $this->render('Onibus\atualizar_onibus.html.twig');
    }

    public function listarOnibus()
    {
        $alunoService = new OnibusService($this->em, $this->onibusRepository);
        $onibus = $alunoService->listarOnibus();

        return $this->render('Onibus\listar_onibus.html.twig', ["allOnibus" => $onibus]);
    }
}