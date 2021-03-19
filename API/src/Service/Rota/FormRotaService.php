<?php


namespace App\Service\Rota;


use App\Entity\Rota;
use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Service\Rota\Storage\FormRotaStorage;
use App\Service\Rota\Validation\RotaValidation;
use Doctrine\DBAL\Exception\ConnectionException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class FormRotaService
{
    private $em;

    private $extratorRequest;

    public function __construct(EntityManager $em, ExtratorDadosDoRequest $extratorRequest)
    {
        $this->em = $em;
        $this->extratorRequest = $extratorRequest;
    }

    public function cadastrar($dadosEmJson)
    {
        $formRotaStorage = new FormRotaStorage($this->em);

        $rotaValidation = new RotaValidation();

        $parseRota = new ParserRota();

        $formRota= new RegraCadastrarRota();
        $formRota->setRotaValidation($rotaValidation);
        $formRota->setParseRota($parseRota);
        $formRota->setRotaStorage($formRotaStorage);

        $rota = $this->getNovaRota();
        if (!is_null($rota)){
            $rotaInfo = $formRota->cadastrar($dadosEmJson, $rota);
        }

        return $rotaInfo;
    }

    public function atualizar($dadosEmJson, $id)
    {
        $rota = $this->getRota($id);
        $rotaExiste = !is_null($rota);
        $rotaInfo = null;

        if ($rotaExiste){

            $formRotaStorage = new FormRotaStorage($this->em);

            $rotaValidation = new RotaValidation();

            $parseRota = new ParserRota();


            $formRota= new RegraAtualizarRota();
            $formRota->setRotaValidation($rotaValidation);
            $formRota->setParseRota($parseRota);
            $formRota->setRotaStorage($formRotaStorage);

            $rotaInfo = $formRota->atualizar($dadosEmJson, $rota);
        } else {
            return new \Exception("Rota inexistente", Response::HTTP_NOT_FOUND);
        }

        return $rotaInfo;
    }

    public function apagar($id)
    {
        $rota = $this->getRota($id);
        $rotaExiste = !is_null($rota);
        $rotaInfo = null;

        if (!$rotaExiste){
            return new \Exception("Rota inexistente", Response::HTTP_NOT_FOUND);
        } else {
            $formRotaStorage = new FormRotaStorage($this->em);
            $formRota = new RegraApagarRota($formRotaStorage);
            $rotaInfo = $formRota->apagar($rota);
        }
        return $rotaInfo;
    }

    public function buscarRota($id)
    {
        $formRotaStorage = new FormRotaStorage($this->em);
        $rotaInfo = $formRotaStorage->getRotaPorId($id);

        return $rotaInfo;
    }

    public function buscarTodos($request)
    {
        $ordenacao = $this->extratorRequest->buscadorDadosOrdenacao($request);

        $filtro = $this->extratorRequest->bucadorDadosFiltro($request);

        [$paginaAtual, $itensPorPagina] = $this->extratorRequest->infoPaginacao($request);

        try{
            $rotaRepository = $this->em->getRepository(Rota::class);
            $qntd = count($rotaRepository->findAll());
            $lista = $rotaRepository->findBy($filtro, $ordenacao,$itensPorPagina,($paginaAtual-1)* $itensPorPagina);

        }catch (ConnectionException $error){
            throw new \Exception('Erro ao se conectar ao banco de dados, verifique a existencia do mesmo', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $responseFactory = new ResponseHelper(true, $lista, Response::HTTP_OK, $qntd, $paginaAtual, $itensPorPagina);

        return $responseFactory->getResponse();
    }

    public function getRota($id)
    {
        $id = isset($id) ? $id : 0;

        $rotaRepository = $this->em->getRepository(Rota::class);
        $rota = $rotaRepository->find($id);

        return $rota;
    }

    public function getNovaRota()
    {
        $rota = new Rota();

        return $rota;
    }
}