<?php


namespace App\Service\Aluno\Validation;

use Symfony\Component\HttpFoundation\Response;

class AlunoValidation
{

    public function validate($dadosEmJson)
    {

        if (strlen($dadosEmJson->nome )<= 2){;
            throw new \Exception("O campo (nome) é inválido", Response::HTTP_BAD_REQUEST);
        }elseif (!preg_match('^[0-9]{2,3}[0-9]{4}[0-9]{4}$^',$dadosEmJson->numero_contato)){
            throw new \Exception("O campo (numero_contato) é inválido",Response::HTTP_BAD_REQUEST);
        }elseif (!filter_var($dadosEmJson->email,FILTER_VALIDATE_EMAIL)){
            throw new \Exception("O campo (email) é invalido", Response::HTTP_BAD_REQUEST);
        }elseif(!preg_match('^[0-9]{3}[0-9]{4}$^',$dadosEmJson->ra)){
            throw new \Exception("O campo (ra) invalido", Response::HTTP_BAD_REQUEST);
        }elseif(strlen($dadosEmJson->bairro) <= 2){
            throw new \Exception("O campo (bairro) é inválido", Response::HTTP_BAD_REQUEST);
        }elseif (strlen($dadosEmJson->rua) <= 2){
            throw new \Exception("O campo (rua) é inválido", Response::HTTP_BAD_REQUEST);
        }elseif (strlen($dadosEmJson->numero_casa) <= 0){
            return new \Exception("O campo (numero_casa) é inválido", Response::HTTP_BAD_REQUEST);
        }

        return $dadosEmJson;
    }

}