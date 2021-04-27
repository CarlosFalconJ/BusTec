<?php


namespace App\Service\Rota;


use App\Repository\RotaRepository;
use Doctrine\ORM\EntityManagerInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\expr;

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

    public function buscarTodasRotas()
    {
        $rotas = $this->rotaRepository->buscarRotasNomeID();
        return $rotas;
    }

    public function buscarTodosOnibus()
    {
        $onibus = $this->rotaRepository->buscarOnibusPlacaID();
        return $onibus;
    }

    public function buscarTodoPontos()
    {
        $pontos = $this->rotaRepository->buscaPontosNomeID();
        return $pontos;
    }

    public function buscaVinculadosRotaOnibus($id_rota)
    {
        $rotasOnibus = $this->rotaRepository->buscarVinculosOnibus($id_rota);

        return $rotasOnibus;
    }

    public function buscaVinculadosRotaPonto($id_rota)
    {
        $rotasPonto= $this->rotaRepository->buscarVinculosPonto($id_rota);
        return $rotasPonto;
    }

}