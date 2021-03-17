<?php


namespace App\Service\Aluno;


use App\Entity\Aluno;
use App\Service\Aluno\Storage\FormAlunoStorage;
use App\Service\Aluno\Validatiom\AlunoValidation;

class RegraAtualizarAluno
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

    public function atualizar($dadosJson, Aluno $aluno)
    {
        $dadosJsonIsValid = $this->alunoValidation->validate($dadosJson);

        $alunoInfo = [];

        if ($dadosJsonIsValid){
            $this->parser->setAlunoFromData($dadosJson, $aluno);
            $this->storage->save($aluno);
            $alunoInfo = $aluno->jsonSerialize();
        }
        return $alunoInfo;
    }
}