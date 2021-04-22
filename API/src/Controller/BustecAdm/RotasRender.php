<?php


namespace App\Controller\BustecAdm;


use App\Repository\RotaRepository;
use App\Service\Rota\RotaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RotasRender extends  AbstractController
{
    private $em;

    private $rotaRepository;

    public function __construct(EntityManagerInterface $em, RotaRepository $rotaRepository)
    {

        $this->em = $em;
        $this->rotaRepository = $rotaRepository;
    }

    public function cadastroRotas()
    {
        return $this->render('Rota\cadastro_rota.html.twig');
    }

    public function atualizarRotas()
    {
        return $this->render('Rota\atualizar_rota.html.twig');
    }

    public function listarRotas()
    {
        $rotaService = new RotaService($this->em, $this->rotaRepository);
        $rotas = $rotaService->listarRotas();

        return $this->render('Rota\listar_rotas.html.twig', ["rotas" => $rotas]);
    }

    public function vinculaRotaOnibus()
    {
        $rotaService = new RotaService($this->em, $this->rotaRepository);
        $rotas = $rotaService->buscarTodasRotas();
        $onibus = $rotaService->buscarTodosOnibus();

        return $this->render('Rota\vincular_rota-onibus.html.twig',["rotas" => $rotas, "allOnibus" => $onibus]);
    }
}