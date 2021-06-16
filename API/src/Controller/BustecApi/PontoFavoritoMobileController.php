<?php


namespace App\Controller\BustecApi;


use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Repository\LoginAcessTokenRepository;
use App\Service\PontosFavoritosMobile\FormPontoFavoritoService;
use App\Service\UserPontoFavorito\FormUserPontoFavoritoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PontoFavoritoMobileController
{
    private $em;

    private $dadosDoRequest;
    /**
     * @var LoginAcessTokenRepository
     */
    private $tokenRepository;

    public function __construct(EntityManagerInterface $em, ExtratorDadosDoRequest $dadosDoRequest, LoginAcessTokenRepository $tokenRepository)
    {
        $this->em = $em;
        $this->dadosDoRequest = $dadosDoRequest;
        $this->tokenRepository = $tokenRepository;
    }

    public function insertPontoFavorito(Request $request, int $id_ponto)
    {
        $token =  explode('Bearer ',$request->headers->get('authorization'));
        $token = $token[1];
        $repository =  $this->tokenRepository->findOneBy(['token' => $token]);

        $id_user = $repository->getId();

        $dadosEmJson = json_decode($request->getContent());
        $formUserPontoFavoritoService = new FormPontoFavoritoService($this->em, $this->dadosDoRequest);
        $formUserPontoService = new FormUserPontoFavoritoService($this->em, $this->dadosDoRequest);

        $id_ponto_favorito = $formUserPontoFavoritoService->cadastrar($dadosEmJson,  $id_ponto);

        $user_pontoF = $formUserPontoService->insert($id_user,  $id_ponto_favorito);

        $response = new ResponseHelper(true, $user_pontoF, Response::HTTP_CREATED );
        return $response->getResponse();
    }

    public function buscarPontoFavorito(Request $request)
    {
        $token =  explode('Bearer ',$request->headers->get('authorization'));
        $token = $token[1];
        $repository =  $this->tokenRepository->findOneBy(['token' => $token]);

        $id_user = $repository->getId();

        $formUserPontoService = new FormPontoFavoritoService($this->em, $this->dadosDoRequest);

        $user_pontoF = $formUserPontoService->busca($id_user);

        $response = new ResponseHelper(true, $user_pontoF, Response::HTTP_CREATED );
        return $response->getResponse();
    }
}