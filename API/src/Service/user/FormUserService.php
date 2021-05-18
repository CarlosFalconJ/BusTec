<?php


namespace App\Service\user;


use App\Entity\User;
use App\Helper\ExtratorDadosDoRequest;
use App\Service\user\UserStorage\FormUserStorage;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class FormUserService
{
    private $em;

    private $extratorRequest;

    public function __construct(EntityManager $em, ExtratorDadosDoRequest $extratorRequest)
    {
        $this->em = $em;
        $this->extratorRequest = $extratorRequest;
    }

    public function cadatrar($dadosEmJson)
    {

        if (is_null($dadosEmJson->usuario) || is_null($dadosEmJson->senha)) {
            return new JsonResponse([
                'erro' => 'Favor enviar usuário e senha'
            ], Response::HTTP_BAD_REQUEST);

        }

        $password = password_hash($dadosEmJson->senha, PASSWORD_ARGON2I);
        $user = new User();

        $user->setUsername($dadosEmJson->usuario);
        $user->setPassword($password);

        $formUserStorage = new FormUserStorage($this->em);
        $formUser = new RegraCadastrarUser();
        $formUser->setUserstorage($formUserStorage);
        $rotaInfo = $formUser->cadastrar($user);

        return $rotaInfo;
    }
}