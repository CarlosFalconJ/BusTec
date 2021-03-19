<?php


namespace App\Controller;


use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Service\Rota\FormRotaService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RotaController
{
    private $em;

    private $dadosDoRequest;

    public function __construct(EntityManagerInterface $em, ExtratorDadosDoRequest $dadosDoRequest)
    {
        $this->em = $em;
        $this->dadosDoRequest = $dadosDoRequest;
    }

    public function insertRota(Request $request)
    {
        $dadosEmJSon = json_decode($request->getContent());

        $formRotaService = new FormRotaService($this->em, $this->dadosDoRequest);
        $rota = $formRotaService->cadastrar($dadosEmJSon);

        $response = new ResponseHelper(true, $rota, Response::HTTP_CREATED );
        return $response->getResponse();
    }

    public function buscarTodasRotas(Request $request)
    {
        $formRotaService = new FormRotaService($this->em, $this->dadosDoRequest);
        $response  = $formRotaService->buscarTodos($request);

        return $response;
    }

    public function updateRota(int $id, Request $request)
    {
        $dadosEmJson = json_decode($request->getContent());

        $formRotaService = new FormRotaService($this->em, $this->dadosDoRequest);
        $rota = $formRotaService->atualizar($dadosEmJson, $id);

        $response = new ResponseHelper(true, $rota, Response::HTTP_OK );
        return $response->getResponse();
    }

    public function deleteRota(int $id)
    {
        $formRotaService = new FormRotaService($this->em, $this->dadosDoRequest);
        $rota = $formRotaService->apagar($id);

        $response = new ResponseHelper(true, $rota, Response::HTTP_OK );
        return $response->getResponse();
    }

    public function buscarRota($id)
    {
        $formRotaService = new FormRotaService($this->em, $this->dadosDoRequest);
        $rota = $formRotaService->buscarRota($id);

        $response = new ResponseHelper(true, $rota, Response::HTTP_OK );
        return $response->getResponse();
    }
}