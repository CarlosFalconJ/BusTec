<?php


namespace App\Service\Onibus\Validation;


use Symfony\Component\HttpFoundation\Response;

class OnibusValidation
{
    public function validate($dadosEmJson)
    {
        if (strlen($dadosEmJson->placa) <= 6){
             throw new \Exception("O campo (placa) é inválido", Response::HTTP_BAD_REQUEST);
        }elseif (strlen($dadosEmJson->motorista_responsavel) <=2){
            throw new \Exception("O campo (mototista_responsavel) é inválido", Response::HTTP_BAD_REQUEST);
        }

        return true;
    }
}