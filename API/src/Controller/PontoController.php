<?php


namespace App\Controller;


use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Service\Ponto\FormPontoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PontoController
{
    private $em;

    private $dadosDoRequest;

    public function __construct(EntityManagerInterface $em, ExtratorDadosDoRequest $dadosDoRequest)
    {
        $this->em = $em;
        $this->dadosDoRequest = $dadosDoRequest;
    }

    public function insertPonto(Request $request)
    {
        $dadosEmJSon = json_decode($request->getContent());

        $formPontoService = new FormPontoService($this->em, $this->dadosDoRequest);
        $ponto = $formPontoService->cadastrar($dadosEmJSon);

        $response = new ResponseHelper(true, $ponto, Response::HTTP_CREATED );
        return $response->getResponse();
    }

    public function buscarTodosPontos(Request $request)
    {
        $formPontoService = new FormPontoService($this->em, $this->dadosDoRequest);
        $response  = $formPontoService->buscarTodos($request);

        return $response;
    }

    public function updatePonto(int $id, Request $request)
    {
        $dadosEmJson = json_decode($request->getContent());

        $formPontoService = new FormPontoService($this->em, $this->dadosDoRequest);
        $ponto = $formPontoService->atualizar($dadosEmJson, $id);

        $response = new ResponseHelper(true, $ponto, Response::HTTP_OK );
        return $response->getResponse();
    }

    public function deletePonto(int $id)
    {
        $formPontoService = new FormPontoService($this->em, $this->dadosDoRequest);
        $ponto = $formPontoService->apagar($id);

        $response = new ResponseHelper(true, $ponto, Response::HTTP_OK );
        return $response->getResponse();
    }

    public function buscarPonto($id)
    {
        $formPontoService = new FormPontoService($this->em, $this->dadosDoRequest);
        $ponto = $formPontoService->buscarPonto($id);

        $response = new ResponseHelper(true, $ponto, Response::HTTP_OK );
        return $response->getResponse();
    }
}