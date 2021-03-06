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

    public function vinculaRotaPonto()
    {
        $rotaService = new RotaService($this->em, $this->rotaRepository);
        $rotas = $rotaService->buscarTodasRotas();
        $pontos = $rotaService->buscarTodoPontos();

        return $this->render('Rota\vincular_rota-ponto',["rotas" => $rotas, "pontos" => $pontos]);
    }

    public function vinculosOnibusPontos($id_rota)
    {
        $rotaService = new RotaService($this->em, $this->rotaRepository);
        $rotasOnibus = $rotaService->buscaVinculadosRotaOnibus($id_rota);
        $rotasPontos = $rotaService->buscaVinculadosRotaPonto($id_rota);

        return $this->render('Rota\visualizarVinculos.html.twig',["rotasOnibus" => $rotasOnibus, "rotasPontos" => $rotasPontos]);
    }
    
    public function atualizarRotaPonto()
    {
        $rotaService = new RotaService($this->em, $this->rotaRepository);
        $rotas = $rotaService->buscarTodasRotas();
        $pontos = $rotaService->buscarTodoPontos();

        return $this->render('Rota\atualizar-rota-ponto.html.twig',["rotas" => $rotas, "pontos" => $pontos]);
    }

    public function atualizarRotaOnibus()
    {
        $rotaService = new RotaService($this->em, $this->rotaRepository);
        $rotas = $rotaService->buscarTodasRotas();
        $onibus = $rotaService->buscarTodosOnibus();

        return $this->render('Rota\atualiza-rota-onibus.html.twig',["rotas" => $rotas, "allOnibus" => $onibus]);
    }
}
