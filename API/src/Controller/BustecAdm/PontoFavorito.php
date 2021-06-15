<?php


namespace App\Controller\BustecAdm;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;

class PontoFavorito extends AbstractController
{
    public function cadastrar(Request $request, $id_ponto)
    {
        $info = $request->getPathInfo();
        $uri = $request->getRequestUri();
        $id_user = $request->getUser();


        $this->redirect('/mobile' . $id_user. '/ponto/' . $id_ponto. '/ponto-favorito', $info);
    }
}