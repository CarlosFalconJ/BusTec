<?php


namespace App\Controller\BustecAdm;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Render extends AbstractController
{
    public function base()
    {
        return $this->render('Aluno\listar_alunos.html.twig');
    }
    public function cadastrar()
    {
        return $this->render('Index\cadastro.html.twig');
    }

    public function editar()
    {
        return $this->render('Index\editar.html.twig');
    }
}