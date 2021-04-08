<?php


namespace App\Controller\BustecApi;


use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseHelper;
use App\Service\Aluno\FormAlunoService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AlunoController
{
    private $em;

    private $dadosDoRequest;

    public function __construct(EntityManagerInterface $em, ExtratorDadosDoRequest $dadosDoRequest)
    {
        $this->em = $em;
        $this->dadosDoRequest = $dadosDoRequest;
    }

    public function insertAluno(int $id_onibus, Request $request)
    {
        $dadosEmJSon = json_decode($request->getContent());

        $formAlunoService = new FormAlunoService($this->em, $this->dadosDoRequest);
        $aluno = $formAlunoService->cadastrar($id_onibus, $dadosEmJSon);

        $response = new ResponseHelper(true, $aluno, Response::HTTP_CREATED );
        return $response->getResponse();
    }

    public function buscarTodosAlunos(Request $request)
    {
       $formAlunoService =  new FormAlunoService($this->em, $this->dadosDoRequest);
       $response  = $formAlunoService->buscarTodos($request);

       return $response;
    }

    public function updateAluno(int $id, Request $request)
    {
        $dadosEmJson = json_decode($request->getContent());

        $formAlunoService = new FormAlunoService($this->em, $this->dadosDoRequest);
        $aluno =$formAlunoService->atualizar($dadosEmJson, $id);

        $response = new ResponseHelper(true, $aluno, Response::HTTP_OK );
        return $response->getResponse();
    }

    public function deleteAluno($id)
    {
        $formAlunoService = new FormAlunoService($this->em, $this->dadosDoRequest);
        $aluno = $formAlunoService->apagar($id);

        $response = new ResponseHelper(true, $aluno, Response::HTTP_OK );
        return $response->getResponse();
    }

    public function buscarAluno($id)
    {
        $formAlunoService = new FormAlunoService($this->em, $this->dadosDoRequest);
        $aluno = $formAlunoService->buscarAluno($id);

        $response = new ResponseHelper(true, $aluno, Response::HTTP_OK );
        return $response->getResponse();
    }
}