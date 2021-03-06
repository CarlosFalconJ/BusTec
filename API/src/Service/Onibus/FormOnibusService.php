<?php


namespace App\Service\Onibus;


use App\Entity\Onibus;
use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Service\Onibus\Storage\FormOnibusStorage;
use App\Service\Onibus\Validation\OnibusValidation;
use Doctrine\DBAL\Exception\ConnectionException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class FormOnibusService
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
        $formOnibusStorage = new FormOnibusStorage($this->em);

        $onibusValidation = new OnibusValidation();

        $parseOnibus = new ParserOnibus();

        $formOnibus = new RegraCadastrarOnibus();
        $formOnibus->setOnibusalidation($onibusValidation);
        $formOnibus->setParseOnibus($parseOnibus);
        $formOnibus->setOnibusStorage($formOnibusStorage);

        $onibus = $this->getNovoOnibus();
        if (!is_null($onibus)){
            $onibusInfo = $formOnibus->cadastrar($dadosEmJson, $onibus);
        }

        return $onibusInfo;
    }

    public function atualizar($dadosEmJson, $id)
    {
        $onibus = $this->getOnibus($id);
        $onibusExiste = !is_null($onibus);
        $onibusInfo = null;

        if ($onibusExiste){

            $formOnibusStorage = new FormOnibusStorage($this->em);

            $onibusValidation = new OnibusValidation();

            $parseOnibus = new ParserOnibus();


            $formOnibus = new RegraAtualizarOnibus();
            $formOnibus->setOnibusValidation($onibusValidation);
            $formOnibus->setParseOnibus($parseOnibus);
            $formOnibus->setAOnibusStorage($formOnibusStorage);

            $onibusInfo = $formOnibus->atualizar($dadosEmJson, $onibus);
        } else {
            return new \Exception("Onibus inexistente", Response::HTTP_NOT_FOUND);
        }

        return $onibusInfo;
    }

    public function apagar($id)
    {
        $onibus = $this->getOnibus($id);
        $onibusExiste = !is_null($onibus);
        $onibusInfo = null;

        if (!$onibusExiste){
            return new \Exception("Onibus inexistente", Response::HTTP_NOT_FOUND);
        } else {
            $formOnibusStorage = new FormOnibusStorage($this->em);
            $formOnibus = new RegraApagarOnibus($formOnibusStorage);
            $onibusInfo = $formOnibus->apagar($onibus);
        }
        return $onibusInfo;
    }

    public function buscarOnibus ($id)
    {
        $formOnibusStorage = new FormOnibusStorage($this->em);
        $onibusInfo = $formOnibusStorage->getOnibusPorId($id);

        return $onibusInfo;
    }

    public function buscarTodos($request)
    {
        $ordenacao = $this->extratorRequest->buscadorDadosOrdenacao($request);

        $filtro = $this->extratorRequest->bucadorDadosFiltro($request);

        [$paginaAtual, $itensPorPagina] = $this->extratorRequest->infoPaginacao($request);

        try{
            $onibusRepository = $this->em->getRepository(Onibus::class);
            $qntd = count($onibusRepository->findAll());
            $lista = $onibusRepository->findBy($filtro, $ordenacao,$itensPorPagina,($paginaAtual-1)* $itensPorPagina);

        }catch (ConnectionException $error){
            throw new \Exception('Erro ao se conectar ao banco de dados, verifique a existencia do mesmo', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $responseFactory = new ResponseHelper(true, $lista, Response::HTTP_OK, $qntd, $paginaAtual, $itensPorPagina);

        return $responseFactory->getResponse();
    }



    public function getOnibus($id)
    {
        $id = isset($id) ? $id : 0;

        $onibusRepository = $this->em->getRepository(Onibus::class);
        $onibus = $onibusRepository->find($id);

        return $onibus;
    }

    public function getNovoOnibus()
    {
        $onibus = new Onibus();

        return $onibus;

    }
}