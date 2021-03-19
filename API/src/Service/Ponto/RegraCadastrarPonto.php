<?php


namespace App\Service\Ponto;


use App\Entity\Ponto;
use App\Service\Ponto\Storage\FormPontoStorage;
use App\Service\Ponto\Validation\PontoValidation;

class RegraCadastrarPonto
{
    private $storage;

    private $pontoValidation;

    private $parser;

    public function setPontoValidation(PontoValidation $validation)
    {
        $this->pontoValidation = $validation;
    }

    public function setParsePonto(ParserPonto $parser)
    {
        $this->parser = $parser;
    }

    public function setPontoStorage(FormPontoStorage $storage)
    {
        $this->storage = $storage;
    }

    public function cadastrar($dadosEmJson, Ponto $ponto)
    {
        $dadosEmJsonIsValid = $this->pontoValidation->validate($dadosEmJson);
        $pontoInfo = [];

        if ($dadosEmJsonIsValid){
            $this->parser->setPontoFromData($dadosEmJson, $ponto);
            $this->storage->save($ponto);
            $pontoInfo = $ponto->jsonSerialize();
        }

        return $pontoInfo;
    }
}