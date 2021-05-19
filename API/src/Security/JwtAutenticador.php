<?php


namespace App\Security;


use App\Repository\UserRepository;
use Firebase\JWT\JWT;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class JwtAutenticador extends AbstractGuardAuthenticator
{
    private $repository;

    private $urlGenerator;

    private $session;

    public function __construct(UserRepository $repository, UrlGeneratorInterface $urlGenerator, SessionInterface $session)
    {
        $this->repository = $repository;
        $this->urlGenerator = $urlGenerator;
        $this->session = $session;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // TODO: Implement start() method.
    }

    public function supports(Request $request)
    {
         if($request->getPathInfo() !== '/bustec/login' || $request->getPathInfo() !== '/login'){
             return $request->getPathInfo();
         }
    }

    public function getCredentials(Request $request)
    {
        $cookies = $request->cookies;

        $token = str_replace(
            'Bearer ',
            '',
            $cookies->get('access_token')
        );

        try {
            return JWT::decode($token, 'chave', ['HS256']);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if (!is_object($credentials) || !property_exists($credentials, 'username')) {
            return null;
        }
        $username = $credentials->username;
        return $this->repository->findOneBy(['username' => $username]);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        if ($user->getRoles() == "ROLE_USER_MOBILE"){
            return null;
        }
        return is_object($credentials) && property_exists($credentials, 'username');
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $this->session->getFlashBag()->add('note', 'Você não tem acesso á essa pagina!!');

        return new RedirectResponse($this->urlGenerator->generate('login_web'));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function supportsRememberMe()
    {
        return false;
    }
}