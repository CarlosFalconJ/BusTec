<?php


namespace App\Controller\BustecAdm;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LoginRender extends AbstractController
{
    public function login()
    {
        return $this->render('login\index.html.twig');
    }
}