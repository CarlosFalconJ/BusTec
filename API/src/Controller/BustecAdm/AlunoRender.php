<?php


namespace App\Controller\BustecAdm;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Render extends AbstractController
{
    public function base()
    {
        return $this->render('Base\base.html.twig');
    }
    public function cadastroALuno()
    {
        return $this->render('Aluno\cadastro_aluno.html.twig');
    }

    public function atualizarAluno()
    {
        return $this->render('Aluno\atualizar_aluno.html.twig');
    }
}