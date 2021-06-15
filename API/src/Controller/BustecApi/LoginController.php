<?php

namespace App\Controller\BustecApi;

use App\Entity\LoginAcessToken;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper;
use Firebase\JWT\JWT;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class LoginController extends AbstractController
{
    private $repository;

    private $encoder;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $encoder,EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->encoder = $encoder;
        $this->entityManager = $entityManager;
    }

    public function index(Request $request)
    {
        $dadosEmJson = json_decode($request->getContent());
        if (is_null($dadosEmJson->usuario) || is_null($dadosEmJson->senha)) {
            return new JsonResponse([
                'erro' => 'Favor enviar usuário e senha'
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->repository->findOneBy([
            'username' => $dadosEmJson->usuario
        ]);
      
        if (!$this->encoder->isPasswordValid($user, $dadosEmJson->senha)) {
            return new JsonResponse([
                'erro' => 'Usuário ou senha inválidos'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = JWT::encode(['username' => $user->getUsername()], 'chave', 'HS256');

        $acess = new LoginAcessToken();
        $acess->setUser($user);
        $acess->setToken($token);

        $this->entityManager->persist($acess);
        $this->entityManager->flush();

        return new JsonResponse(setcookie(
            'access_token', $token
        ));
    }
}