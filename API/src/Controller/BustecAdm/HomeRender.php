<?php


namespace App\Controller\BustecAdm;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeRender extends AbstractController
{
    public function home()
    {
        return $this->render('Home\home.html.twig');
    }
}