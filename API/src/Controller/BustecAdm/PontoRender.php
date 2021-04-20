<?php


namespace App\Controller\BustecAdm;


use App\Repository\PontoRepository;
use App\Service\Ponto\PontoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PontoRender extends AbstractController
{
    private $em;

    private $pontoRepository;

    public function __construct(EntityManagerInterface $em, PontoRepository $pontoRepository)
    {

        $this->em = $em;
        $this->pontoRepository = $pontoRepository;
    }

    public function cadastroPonto()
    {
        return $this->render('Ponto\cadastro_ponto.html.twig');
    }

    public function atualizarPonto()
    {
        return $this->render('Ponto\atualizar_ponto.html.twig');
    }

    public function listarPonto()
    {
        $pontoService = new PontoService($this->em, $this->pontoRepository);
        $pontos = $pontoService->listarRotas();

        return $this->render('Ponto\listar-pontos.html.twig', ["pontos" => $pontos]);
    }
}