<?php


namespace App\Service\Onibus\Validation;


use Symfony\Component\HttpFoundation\Response;

class OnibusValidation
{
    public function validate($dadosJson)
    {
        if (empty($dadosJson->placa)){
            return new \Exception("O campo (placa) não pode ser vazio", Response::HTTP_BAD_REQUEST);
        }elseif (empty($dadosJson->motorista_responsavel)){
            return new \Exception("O campo (motorista_responsavel) não pode ser vazio",Response::HTTP_BAD_REQUEST);
        }

        return true;
    }
}