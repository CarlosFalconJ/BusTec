<?php


namespace App\Service\Ponto;


use App\Entity\Ponto;
use App\Service\Ponto\Storage\FormPontoStorage;
use App\Service\Ponto\Validation\PontoValidation;

class RegraAtualizarPonto
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

    public function cadastrar($dadosJson, Ponto $ponto)
    {
        $dadosJsonIsValid = $this->pontoValidation->validate($dadosJson);

        $pontoInfo = [];

        if ($dadosJsonIsValid){
            $this->parser->setPontoFromData($dadosJson, $ponto);
            $this->storage->save($ponto);
            $pontoInfo = $ponto->jsonSerialize();
        }
        return $pontoInfo;
    }
}