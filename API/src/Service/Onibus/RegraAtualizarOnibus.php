<?php


namespace App\Service\Onibus;


use App\Entity\Onibus;
use App\Service\Onibus\Storage\FormOnibusStorage;
use App\Service\Onibus\Validation\OnibusValidation;

class RegraAtualizarOnibus
{
    private $storage;

    private $onibusValidation;

    private $parser;

    public function setOnibusValidation(OnibusValidation $validation)
    {
        $this->onibusValidation = $validation;
    }

    public function setParseOnibus(ParserOnibus $parser)
    {
        $this->parser = $parser;
    }

    public function setAOnibusStorage(FormOnibusStorage $storage)
    {
        $this->storage = $storage;
    }

    public function atualizar($dadosJson, Onibus $onibus)
    {
        $dadosJsonIsValid = $this->onibusValidation->validate($dadosJson);

        $onibusInfo = [];

        if ($dadosJsonIsValid){
            $this->parser->setOnibusFromData($dadosJson, $onibus);
            $this->storage->save($onibus);
            $onibusInfo = $onibus->jsonSerialize();
        }
        return $onibusInfo;
    }
}