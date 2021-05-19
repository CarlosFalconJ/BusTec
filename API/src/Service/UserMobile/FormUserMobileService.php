<?php


namespace App\Service\UserMobile;


use App\Entity\User;
use App\Entity\UserMobile;
use App\Helper\ExtratorDadosDoRequest;
use App\Repository\AlunoRepository;
use App\Service\user\RegraCadastrarUser;
use App\Service\user\UserStorage\FormUserStorage;
use App\Service\UserMobile\UserMobileStorage\FormUserMobileStorage;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class FormUserMobileService
{
    private $em;

    private $extratorRequest;

    private $repository;

    public function __construct(EntityManager $em, ExtratorDadosDoRequest $extratorRequest, AlunoRepository $repository)
    {
        $this->em = $em;
        $this->extratorRequest = $extratorRequest;
        $this->repository = $repository;
    }

    public function cadastrar($dadosEmJson)
    {

        if (is_null($dadosEmJson->usuario) || is_null($dadosEmJson->senha)) {
            return new JsonResponse([
                'erro' => 'Favor enviar usuário e senha'
            ], Response::HTTP_BAD_REQUEST);

        }

        $aluno = $this->repository->findOneBy([
            "numero_contato" => $dadosEmJson->usuario
        ]);

        if (is_null($aluno)){
            throw new \Exception('Você deve ter uma cadastro no Adm para fazer o login!!', Response::HTTP_BAD_REQUEST);
        }

        $password = password_hash($dadosEmJson->senha, PASSWORD_ARGON2I);
        $tel = $aluno->getNumeroContato();
        $user = new UserMobile();

        $user->setUsername($tel);
        $user->setPassword($password);

        $formUserMobileStorage = new FormUserMobileStorage($this->em);
        $formUser = new RegraCadastrarUserMobile();
        $formUser->setUserMobilestorage($formUserMobileStorage);
        $rotaInfo = $formUser->cadastrar($user);

        return $rotaInfo;
    }
}