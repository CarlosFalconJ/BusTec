<?php


namespace App\Service\Ponto\Validation;


use Symfony\Component\HttpFoundation\Response;

class PontoValidation
{
    public function validate($dadosEmJson)
    {
        if (strlen($dadosEmJson->nome) <= 2){
            throw new \Exception("O campo (nome) é inválido", Response::HTTP_BAD_REQUEST);
        }elseif (strlen($dadosEmJson->bairro) <= 2){
            throw new \Exception("O campo (bairro) é inválido",Response::HTTP_BAD_REQUEST);
        }elseif (strlen($dadosEmJson->rua) <= 2){
            throw new \Exception("O campo (rua) é inválido",Response::HTTP_BAD_REQUEST);
        }elseif (strlen($dadosEmJson->ponto_referencia) <= 2){
            throw new \Exception("O campo (ponto_referencia) é inválido",Response::HTTP_BAD_REQUEST);
        }

        return true;
    }
}