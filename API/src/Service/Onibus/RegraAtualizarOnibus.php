<?php


namespace App\Service\Onibus;


use App\Entity\Onibus;
use App\Service\Onibus\Storage\FormOnibusStorage;
use App\Service\Onibus\Validation\OnibusValidation;

class RegraAtualizarOnibus
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

    public function atualizar($dadosJson, Onibus $onibus)
    {
        $dadosJsonIsValid = $this->alunoValidation->validate($dadosJson);

        $onibusInfo = [];

        if ($dadosJsonIsValid){
            $this->parser->setAlunoFromData($dadosJson, $onibus);
            $this->storage->save($onibus);
            $onibusInfo = $onibus->jsonSerialize();
        }
        return $onibusInfo;
    }
}