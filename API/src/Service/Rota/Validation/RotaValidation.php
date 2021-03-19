<?php


namespace App\Service\Rota\Validation;


use Symfony\Component\HttpFoundation\Response;

class RotaValidation
{
    public function validate($dadosJson)
    {
        if (empty($dadosJson->nome)){
            return new \Exception("O campo (nome) não pode ser vazio", Response::HTTP_BAD_REQUEST);
        }elseif (empty($dadosJson->cidade)){
            return new \Exception("O campo (cidade) não pode ser vazio",Response::HTTP_BAD_REQUEST);
        }

        return true;
    }
}