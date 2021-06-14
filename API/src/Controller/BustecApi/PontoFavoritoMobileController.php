<?php


namespace App\Controller\BustecApi;


use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Service\PontosFavoritosMobile\FormPontoFavoritoService;
use App\Service\UserPontoFavorito\FormUserPontoFavoritoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PontoFavoritoMobileController
{
    private $em;

    private $dadosDoRequest;

    public function __construct(EntityManagerInterface $em, ExtratorDadosDoRequest $dadosDoRequest)
    {
        $this->em = $em;
        $this->dadosDoRequest = $dadosDoRequest;
    }

    public function insertPontoFavorito(int $id_user, int $id_pont_favorito)
    {
        $formUserPontoFavoritoService = new FormUserPontoFavoritoService($this->em, $this->dadosDoRequest);

        $user_pontoF = $formUserPontoFavoritoService->addUserPontoATabela($id_user,  $id_pont_favorito);

        $response = new ResponseHelper(true, $user_pontoF, Response::HTTP_CREATED );
        return $response->getResponse();
    }

    public function vincularUser($id_user, $id_ponto_favorito)
    {
        $formUserPontoService = new FormUserPontoFavoritoService($this->em, $this->dadosDoRequest);

        $user_pontoF = $formUserPontoService->insert($id_user,  $id_ponto_favorito);
        $response = new ResponseHelper(true, $user_pontoF, Response::HTTP_CREATED );
        return $response->getResponse();
    }
}