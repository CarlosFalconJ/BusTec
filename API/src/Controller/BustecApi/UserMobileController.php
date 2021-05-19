<?php


namespace App\Controller\BustecApi;


use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Repository\AlunoRepository;
use App\Service\user\FormUserService;
use App\Service\UserMobile\FormUserMobileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMobileController
{
    private $em;

    private $dadosDoRequest;
    /**
     * @var AlunoRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $em, ExtratorDadosDoRequest $dadosDoRequest, AlunoRepository $repository)
    {
        $this->em = $em;
        $this->dadosDoRequest = $dadosDoRequest;
        $this->repository = $repository;
    }
    public function cadastrarUsuarioMobile(Request $request)
    {
        $dadosEmJson = json_decode($request->getContent());

        $formUser = new FormUserMobileService($this->em, $this->dadosDoRequest, $this->repository);
        $user = $formUser->cadastrar($dadosEmJson);

        $response = new ResponseHelper(true, $user, Response::HTTP_CREATED);
        return $response->getResponse();
    }
}