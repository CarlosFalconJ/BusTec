<?php


namespace App\Service\Aluno;


use App\Repository\AlunoRepository;
use Doctrine\ORM\EntityManagerInterface;

class AlunoService
{
    private $em;

    private $alunoRepository;

    public function __construct(EntityManagerInterface $em, AlunoRepository $alunoRepository)
    {
        $this->em = $em;
        $this->alunoRepository = $alunoRepository;
    }


    public function listarAlunos(){

        $alunos = $this->alunoRepository->buscarTodosAlunos();
        return $alunos;
    }

    public function buscarOnibus()
    {
        $onibus = $this->alunoRepository->buscarTodosOnibus();
        return $onibus;
    }



}