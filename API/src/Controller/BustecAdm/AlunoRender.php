<?php


namespace App\Controller\BustecAdm;



use App\Repository\AlunoRepository;
use App\Service\Aluno\AlunoService;
use App\Service\Aluno\FormAlunoService;
use App\Service\Aluno\Storage\FormAlunoStorage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AlunoRender extends AbstractController

{
    private $em;

    private $alunoRepository;

    public function __construct(EntityManagerInterface $em, AlunoRepository $alunoRepository)
    {

        $this->em = $em;
        $this->alunoRepository = $alunoRepository;
    }

    public function cadastroALuno()
    {
        $alunoService = new AlunoService($this->em, $this->alunoRepository);
        $onibus =$alunoService->buscarOnibus();

        return $this->render('Aluno\cadastro_aluno.html.twig', ["AllOnibus" => $onibus]);
    }

    public function atualizarAluno()
    {
        return $this->render('Aluno\atualizar_aluno.html.twig');
    }

    public function listarAlunos()
    {

         $alunoService = new AlunoService($this->em, $this->alunoRepository);
         $alunos =$alunoService->listarAlunos();

        return $this->render('Aluno\listar_alunos.html.twig', ["alunos" => $alunos]);
    }
}