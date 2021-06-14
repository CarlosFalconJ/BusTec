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

    public function insertPontoFavorito(Request $request, int $id_user, int $id_ponto)
    {
        $dadosEmJson = json_decode($request->getContent());
        $formUserPontoFavoritoService = new FormPontoFavoritoService($this->em, $this->dadosDoRequest);
        $formUserPontoService = new FormUserPontoFavoritoService($this->em, $this->dadosDoRequest);

        $id_ponto_favorito = $formUserPontoFavoritoService->cadastrar($dadosEmJson,  $id_ponto);

        $user_pontoF = $formUserPontoService->insert($id_user,  $id_ponto_favorito);

        $response = new ResponseHelper(true, $user_pontoF, Response::HTTP_CREATED );
        return $response->getResponse();
    }

    public function buscarPontoFavorito(int $id_user)
    {
        $formUserPontoService = new FormPontoFavoritoService($this->em, $this->dadosDoRequest);

        $user_pontoF = $formUserPontoService->busca($id_user);

        $response = new ResponseHelper(true, $user_pontoF, Response::HTTP_CREATED );
        return $response->getResponse();
    }
}