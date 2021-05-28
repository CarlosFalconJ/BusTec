<?php


namespace App\Controller\BustecApi;


use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Service\mobile\ListarPontosMobile\FormPontosMobileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class PontoMobileController
{
    private $em;

    private $dadosDoRequest;

    public function __construct(EntityManagerInterface $em, ExtratorDadosDoRequest $dadosDoRequest)
    {

        $this->em = $em;
        $this->dadosDoRequest = $dadosDoRequest;
    }

    public function listarPontos(int $id)
    {
        $formPontoMobileService = new FormPontosMobileService($this->em, $this->dadosDoRequest);
        $listarPontos  = $formPontoMobileService->listarPontos($id);


        $response = new ResponseHelper(true, $listarPontos, Response::HTTP_OK );
        return $response->getResponse();
    }
}