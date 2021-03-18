<?php


namespace App\Service\Aluno;


use App\Entity\Aluno;
use App\Service\Aluno\Storage\FormAlunoStorage;
use App\Service\Aluno\Validation\AlunoValidation;

class RegraCadastrarAluno
{
    private $storage;

    private $alunoValidation;

    private $parser;

    public function setAlunoValidation(AlunoValidation $validation)
    {
        $this->alunoValidation = $validation;
    }

    public function setParseAluno(ParserAluno $parser)
    {
        $this->parser = $parser;
    }

    public function setAlunoStorage(FormAlunoStorage $storage)
    {
        $this->storage = $storage;
    }

    public function cadastrar($dadosEmJson, Aluno $aluno)
    {
        $dadosEmJsonIsValid = $this->alunoValidation->validate($dadosEmJson);
        $alunoInfo = [];

        if ($dadosEmJsonIsValid){
            $this->parser->setAlunoFromData($dadosEmJson, $aluno);
            $this->storage->save($aluno);
            $alunoInfo = $aluno->jsonSerialize();
        }

        return$alunoInfo;
    }
}