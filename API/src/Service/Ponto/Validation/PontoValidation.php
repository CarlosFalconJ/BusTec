<?php


namespace App\Service\Ponto\Validation;


use Symfony\Component\HttpFoundation\Response;

class PontoValidation
{
    public function validate($dadosJson)
    {
        if (empty($dadosJson->nome)){
            return new \Exception("O campo (nome) não pode ser vazio", Response::HTTP_BAD_REQUEST);
        }elseif (empty($dadosJson->bairro)){
            return new \Exception("O campo (bairro) não pode ser vazio",Response::HTTP_BAD_REQUEST);
        }elseif (empty($dadosJson->rua)){
            return new \Exception("O campo (rua) não pode ser vazio",Response::HTTP_BAD_REQUEST);
        }elseif (empty($dadosJson->ponto_referencia)){
            return new \Exception("O campo (ponto_referencia) não pode ser vazio",Response::HTTP_BAD_REQUEST);
        }

        return true;
    }
}