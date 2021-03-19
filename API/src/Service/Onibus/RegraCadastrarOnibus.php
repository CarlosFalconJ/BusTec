<?php


namespace App\Service\Onibus;


use App\Entity\Onibus;
use App\Service\Onibus\Storage\FormOnibusStorage;
use App\Service\Onibus\Validation\OnibusValidation;

class RegraCadastrarOnibus
{
    private $storage;

    private $alunoValidation;

    private $parser;

    public function setAlunoValidation(OnibusValidation $validation)
    {
        $this->alunoValidation = $validation;
    }

    public function setParseAluno(ParserOnibus $parser)
    {
        $this->parser = $parser;
    }

    public function setAlunoStorage(FormOnibusStorage $storage)
    {
        $this->storage = $storage;
    }

    public function cadastrar($dadosEmJson, Onibus $onibus)
    {
        $dadosEmJsonIsValid = $this->alunoValidation->validate($dadosEmJson);
        $onibusInfo = [];

        if ($dadosEmJsonIsValid){
            $this->parser->setAlunoFromData($dadosEmJson, $onibus);
            $this->storage->save($onibus);
            $onibusInfo = $onibus->jsonSerialize();
        }

        return$onibusInfo;
    }
}