<?php


namespace App\Service\mobile\ListarPontosMobile;


use App\Helper\ExtratorDadosDoRequest;
use App\Service\mobile\ListarPontosMobile\Storage\FormPontosMobileStorage;
use Doctrine\ORM\EntityManager;

class FormPontosMobileService
{
    private $em;

    private $extratorRequest;

    public function __construct(EntityManager $em, ExtratorDadosDoRequest $extratorRequest)
    {
        $this->em = $em;
        $this->extratorRequest = $extratorRequest;
    }

    public function listarPontos ($id)
    {
        $formPontosMobile = new FormPontosMobileStorage($this->em);
        $listaPontosInfo = $formPontosMobile->listarPonto($id);

        return $listaPontosInfo;
    }
}