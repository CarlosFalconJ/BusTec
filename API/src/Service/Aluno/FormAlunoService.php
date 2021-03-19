<?php


namespace App\Service\Aluno;


use App\Entity\Aluno;
use App\Entity\Onibus;
use App\Helper\AppError;
use App\Helper\ExtratorDadosDoRequest;
use App\Helper\ResponseFactory;
use App\Helper\ResponseHelper;
use App\Service\Aluno\Storage\FormAlunoStorage;
use App\Service\Aluno\Validation\AlunoValidation;
use Doctrine\DBAL\Exception\ConnectionException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

class FormAlunoService
{

    private $em;

    private $extratorRequest;

    public function __construct(EntityManager $em, ExtratorDadosDoRequest $extratorRequest)
    {
        $this->em = $em;
        $this->extratorRequest = $extratorRequest;
    }

    public function cadastrar($id_onibus, $dadosEmJson)
    {
        $formAlunoStorage = new FormAlunoStorage($this->em);

        $alunoValidation = new AlunoValidation();

        $parseAluno = new ParserAluno();

        $formAluno = new RegraCadastrarAluno();
        $formAluno->setAlunoValidation($alunoValidation);
        $formAluno->setParseAluno($parseAluno);
        $formAluno->setAlunoStorage($formAlunoStorage);

        $aluno = $this->getNovoAluno($id_onibus);
        if (!is_null($aluno)){
            $alunoInfo = $formAluno->cadastrar($dadosEmJson, $aluno);
        }

        return $alunoInfo;
    }

    public function atualizar($dadosEmJson, $id)
    {
        $aluno = $this->getAluno($id);
        $alunoExiste = !is_null($aluno);
        $alunoInfo = null;

        if ($alunoExiste){

            $formAlunoStorage = new FormAlunoStorage($this->em);

            $alunoValidation = new AlunoValidation();

            $parseAluno = new ParserAluno();

            $formAluno = new RegraAtualizarAluno();
            $formAluno->setAlunoValidation($alunoValidation);
            $formAluno->setParseAluno($parseAluno);
            $formAluno->setAlunoStorage($formAlunoStorage);

            $alunoInfo = $formAluno->atualizar($dadosEmJson, $aluno);
        } else {
            return new \Exception("Aluno inexistente", Response::HTTP_NOT_FOUND);
        }

        return $alunoInfo;
    }

    public function apagar($id)
    {
        $aluno = $this->getAluno($id);
        $alunoExiste = !is_null($aluno);
        $alunoInfo = null;

        if (!$alunoExiste){
            return new \Exception("Aluno inexistente", Response::HTTP_NOT_FOUND);
        } else {
            $formAlunoStorage = new FormAlunoStorage($this->em);
            $formAluno = new RegraApagarAluno($formAlunoStorage);
            $alunoInfo = $formAluno->apagar($aluno);
        }
        return $alunoInfo;
    }

    public function buscarAluno ($id)
    {
        $formAlunoStorage = new FormAlunoStorage($this->em);
        $alunoInfo = $formAlunoStorage->getAlunoPorId($id);

        return $alunoInfo;
    }

    public function buscarTodos($request)
    {
        $ordenacao = $this->extratorRequest->buscadorDadosOrdenacao($request);

        $filtro = $this->extratorRequest->bucadorDadosFiltro($request);

        [$paginaAtual, $itensPorPagina] = $this->extratorRequest->infoPaginacao($request);

        try{
            $alunoRepository = $this->em->getRepository(Aluno::class);
            $qntd = count($alunoRepository->findAll());
            $lista = $alunoRepository->findBy($filtro, $ordenacao,$itensPorPagina,($paginaAtual-1)* $itensPorPagina);

        }catch (ConnectionException $error){
            throw new \Exception('Erro ao se conectar ao banco de dados, verifique a existencia do mesmo', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $responseFactory = new ResponseHelper(true, $lista, Response::HTTP_OK, $qntd, $paginaAtual, $itensPorPagina);

        return $responseFactory->getResponse();
    }


    
    public function getAluno($id)
    {
        $id = isset($id) ? $id : 0;

        $alunoRepository = $this->em->getRepository(Aluno::class);
        $aluno = $alunoRepository->find($id);

        return $aluno;
    }

    public function getNovoAluno($onibus)
    {
        $id_onibus = isset($onibus) ? $onibus : 0;
        $aluno = null;
        $onibusValido = ($id_onibus > 0);

        if ($onibusValido){
            $aluno = new Aluno();

            $onibus = $this->em->getReference(Onibus::class, $id_onibus);

            $aluno->setOnibus($onibus);
        } else {
            return new \Exception("Onubus invalido", Response::HTTP_NOT_FOUND);
        }

        return $aluno;

    }
}