<?php


namespace App\Service\Ponto;


use App\Entity\Ponto;
use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Service\Ponto\Storage\FormPontoStorage;
use App\Service\Ponto\Validation\PontoValidation;
use Doctrine\DBAL\Exception\ConnectionException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class FormPontoService
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
        $formPontoStorage = new FormPontoStorage($this->em);

        $pontoValidation = new PontoValidation();

        $parsePonto = new ParserPonto();

        $formPonto= new RegraCadastrarPonto();
        $formPonto->setPontoValidation($pontoValidation);
        $formPonto->setParsePonto($parsePonto);
        $formPonto->setPontoStorage($formPontoStorage);

        $ponto = $this->getNovaPonto();
        if (!is_null($ponto)){
            $pontoInfo = $formPonto->cadastrar($dadosEmJson, $ponto);
        }

        return $pontoInfo;
    }

    public function atualizar($dadosEmJson, $id)
    {
        $ponto = $this->getPonto($id);
        $pontoExiste = !is_null($ponto);
        $pontoInfo = null;

        if ($pontoExiste){

            $formPontoStorage = new FormPontoStorage($this->em);

            $pontoValidation = new PontoValidation();

            $parsePonto = new ParserPonto();


            $formPonto= new RegraAtualizarPonto();
            $formPonto->setPontoValidation($pontoValidation);
            $formPonto->setParsePonto($parsePonto);
            $formPonto->setPontoStorage($formPontoStorage);

            $pontoInfo = $formPonto->atualizar($dadosEmJson, $ponto);
        } else {
            return new \Exception("Ponto inexistente", Response::HTTP_NOT_FOUND);
        }

        return $pontoInfo;
    }

    public function apagar($id)
    {
        $ponto = $this->getPonto($id);
        $pontoExiste = !is_null($ponto);
        $pontoInfo = null;


        if (!$pontoExiste){
            return new \Exception("Ponto inexistente", Response::HTTP_NOT_FOUND);
        } else {
            $formPontoStorage = new FormPontoStorage($this->em);
            $formPonto = new RegraApagarPonto($formPontoStorage);
            $pontoInfo = $formPonto->apagar($ponto);
        }
        return $pontoInfo;
    }

    public function buscarPonto($id)
    {
        $formPontoStorage = new FormPontoStorage($this->em);
        $pontoInfo = $formPontoStorage->getPontoPorId($id);

        return $pontoInfo;
    }

    public function buscarTodos($request)
    {
        $ordenacao = $this->extratorRequest->buscadorDadosOrdenacao($request);

        $filtro = $this->extratorRequest->bucadorDadosFiltro($request);

        [$paginaAtual, $itensPorPagina] = $this->extratorRequest->infoPaginacao($request);

        try{
            $pontoRepository = $this->em->getRepository(Ponto::class);
            $qntd = count($pontoRepository->findAll());
            $lista = $pontoRepository->findBy($filtro, $ordenacao,$itensPorPagina,($paginaAtual-1)* $itensPorPagina);

        }catch (ConnectionException $error){
            throw new \Exception('Erro ao se conectar ao banco de dados, verifique a existencia do mesmo', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $responseFactory = new ResponseHelper(true, $lista, Response::HTTP_OK, $qntd, $paginaAtual, $itensPorPagina);

        return $responseFactory->getResponse();
    }

    public function getPonto($id)
    {
        $id = isset($id) ? $id : 0;

        $pontoRepository = $this->em->getRepository(Ponto::class);
        $ponto = $pontoRepository->find($id);

        return $ponto;
    }

    public function getNovaPonto()
    {
        $ponto = new Ponto();

        return $ponto;
    }
}