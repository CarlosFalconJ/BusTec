<?php


namespace App\Service\Onibus\Validation;


use Symfony\Component\HttpFoundation\Response;

class OnibusValidation
{
    public function validate($dadosEmJson)
    {
        if (!preg_match('^[A-Z]{3}[0-9]{4}$^',$dadosEmJson->placa)){
             throw new \Exception("O campo (placa) é inválido", Response::HTTP_BAD_REQUEST);
        }elseif (strlen($dadosEmJson->motorista_responsavel) == 0){
            throw new \Exception("O campo (mototista_responsavel) é inválido", Response::HTTP_BAD_REQUEST);
        }

        return $dadosEmJson;
    }
}