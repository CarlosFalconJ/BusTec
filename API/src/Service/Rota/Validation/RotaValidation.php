<?php


namespace App\Service\Rota\Validation;


use Symfony\Component\HttpFoundation\Response;

class RotaValidation
{
    public function validate($dadosEmJson)
    {

        if (strlen($dadosEmJson->nome )<= 2){
            throw new \Exception("O campo (nome) é inválido", Response::HTTP_BAD_REQUEST);
        }elseif (strlen($dadosEmJson->cidade) <= 2){
            throw new \Exception("O campo (cidade) é inválido",Response::HTTP_BAD_REQUEST);
        }

        return true;
    }
}