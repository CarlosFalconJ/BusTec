<?php


namespace App\Service\PontosFavoritosMobile\Validation;


use Symfony\Component\HttpFoundation\Response;

class PontoFavoritoValidation
{
    public function validate($dadosEmJson)
    {
        if (strlen($dadosEmJson->nome) == 0){
            throw new \Exception("O campo (nome) é inválido", Response::HTTP_BAD_REQUEST);
        }

        return $dadosEmJson;
    }
}