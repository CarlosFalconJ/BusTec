<?php


namespace App\Service\Rota;


use App\Entity\Rota;
use App\Service\Rota\Storage\FormRotaStorage;
use App\Service\Rota\Validation\RotaValidation;

class RegraCadastrarRota
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

    public function cadastrar($dadosEmJson, Rota $rota)
    {
        $dadosEmJsonIsValid = $this->rotaValidation->validate($dadosEmJson);
        $rotaInfo = [];

        if ($dadosEmJsonIsValid){
            $this->parser->setRotaFromData($dadosEmJson, $rota);
            $this->storage->save($rota);
            $rotaInfo = $rota->jsonSerialize();
        }

        return $rotaInfo;
    }
}