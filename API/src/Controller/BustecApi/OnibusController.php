<?php


namespace App\Controller\BustecApi;

use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Service\Onibus\FormOnibusService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class OnibusController
{
    private $em;

    private $dadosDoRequest;

    public function __construct(EntityManagerInterface $em, ExtratorDadosDoRequest $dadosDoRequest)
    {
        $this->em = $em;
        $this->dadosDoRequest = $dadosDoRequest;
    }

    public function insertOnibus(Request $request)
    {
        $dadosEmJSon = json_decode($request->getContent());

        $formOnibusService = new FormOnibusService($this->em, $this->dadosDoRequest);
        $onibus = $formOnibusService->cadastrar($dadosEmJSon);

        $response = new ResponseHelper(true, $onibus, Response::HTTP_CREATED );
        return $response->getResponse();
    }

    public function buscarTodosOnibus(Request $request)
    {
        $formOnibusService = new FormOnibusService($this->em, $this->dadosDoRequest);
        $response  = $formOnibusService->buscarTodos($request);

        return $response;
    }

    public function updateOnibus(int $id, Request $request)
    {
        $dadosEmJson = json_decode($request->getContent());

        $formOnibusService = new FormOnibusService($this->em, $this->dadosDoRequest);
        $onibus =$formOnibusService->atualizar($dadosEmJson, $id);

        $response = new ResponseHelper(true, $onibus, Response::HTTP_OK );
        return $response->getResponse();
    }

    public function deleteOnibus($id)
    {
        $formOnibusService = new FormOnibusService($this->em, $this->dadosDoRequest);
        $onibus = $formOnibusService->apagar($id);

        $response = new ResponseHelper(true, $onibus, Response::HTTP_OK );
        return $response->getResponse();
    }

    public function buscarOnibus($id)
    {
        $formOnibusService = new FormOnibusService($this->em, $this->dadosDoRequest);
        $onibus = $formOnibusService->buscarOnibus($id);

        $response = new ResponseHelper(true, $onibus, Response::HTTP_OK );
        return $response->getResponse();
    }
}