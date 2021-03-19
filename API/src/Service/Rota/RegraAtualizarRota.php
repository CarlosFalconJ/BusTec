<?php


namespace App\Service\Rota;


use App\Entity\Rota;
use App\Service\Rota\Storage\FormRotaStorage;
use App\Service\Rota\Validation\RotaValidation;

class RegraAtualizarRota
{
    private $storage;

    private $rotaValidation;

    private $parser;

    public function setRotaValidation(RotaValidation $validation)
    {
        $this->rotaValidation = $validation;
    }

    public function setParseRota(ParserRota $parser)
    {
        $this->parser = $parser;
    }

    public function setRotaStorage(FormRotaStorage $storage)
    {
        $this->storage = $storage;
    }

    public function atualizar($dadosJson, Rota $rota)
    {
        $dadosJsonIsValid = $this->rotaValidation->validate($dadosJson);

        $rotaInfo = [];

        if ($dadosJsonIsValid){
            $this->parser->setRotaFromData($dadosJson, $rota);
            $this->storage->save($rota);
            $rotaInfo = $rota->jsonSerialize();
        }
        return $rotaInfo;
    }
}