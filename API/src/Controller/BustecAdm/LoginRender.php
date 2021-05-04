<?php


namespace App\Controller\BustecAdm;




use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class LoginRender extends AbstractController
{
    public function login(Request $request)
    {

        $response = new Response();

        if ($request->cookies->get('access_token')){
            $response->headers->clearCookie('access_token');
            $response->send();
        }

        return $this->render('login\index.html.twig', [], $response);
    }

}