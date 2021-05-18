<?php


namespace App\Controller\BustecApi;


use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Service\user\FormUserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    private $em;

    private $dadosDoRequest;

    public function __construct(EntityManagerInterface $em, ExtratorDadosDoRequest $dadosDoRequest)
    {
        $this->em = $em;
        $this->dadosDoRequest = $dadosDoRequest;
    }
    public function cadastrarUsuario(Request $request)
    {
        $dadosEmJson = json_decode($request->getContent());

        $formUser = new FormUserService($this->em, $this->dadosDoRequest);
        $user = $formUser->cadatrar($dadosEmJson);

        $response = new ResponseHelper(true, $user, Response::HTTP_CREATED);
        return $response->getResponse();
    }
}