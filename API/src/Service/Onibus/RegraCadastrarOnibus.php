<?php


namespace App\Service\Onibus;


use App\Entity\Onibus;
use App\Service\Onibus\Storage\FormOnibusStorage;
use App\Service\Onibus\Validation\OnibusValidation;

class RegraCadastrarOnibus
{
    private $storage;

    private $onibusValidation;

    private $parser;

    public function setOnibusalidation(OnibusValidation $validation)
    {
        $this->onibusValidation = $validation;
    }

    public function setParseOnibus(ParserOnibus $parser)
    {
        $this->parser = $parser;
    }

    public function setOnibusStorage(FormOnibusStorage $storage)
    {
        $this->storage = $storage;
    }

    public function cadastrar($dadosEmJson, Onibus $onibus)
    {
        $dadosEmJsonIsValid = $this->onibusValidation->validate($dadosEmJson);
        $onibusInfo = [];

        if ($dadosEmJsonIsValid){
            $this->parser->setOnibusFromData($dadosEmJson, $onibus);
            $this->storage->save($onibus);
            $onibusInfo = $onibus->jsonSerialize();
        }

        return $onibusInfo;
    }
}