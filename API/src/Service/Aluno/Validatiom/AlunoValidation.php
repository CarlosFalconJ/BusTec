<?php


namespace App\Service\Aluno\Validatiom;

use Symfony\Component\HttpFoundation\Response;

class AlunoValidation
{

    public function validate($dadosJson)
    {
        if (empty($dadosJson->nome)){
            return new \Exception("O campo (nome) não pode ser vazio", Response::HTTP_BAD_REQUEST);
        }elseif (empty($dadosJson->numero_contato)){
            return new \Exception("O campo (numero_contato) não pode ser vazio",Response::HTTP_BAD_REQUEST);
        }elseif (empty($dadosJson->email)){
            return new \Exception("O campo (email) não pode ser vazio", Response::HTTP_BAD_REQUEST);
        }elseif(empty($dadosJson->ra)){
            return new \Exception("O campo (ra) não pode ser vazio", Response::HTTP_BAD_REQUEST);
        }elseif(empty($dadosJson->bairro)){
            return new \Exception("O campo (bairro) não pode ser vazio", Response::HTTP_BAD_REQUEST);
        }elseif (empty($dadosJson->rua)){
            return new \Exception("O campo (rua) não pode ser vazio", Response::HTTP_BAD_REQUEST);
        }elseif (empty($dadosJson->numero_casa)){
            return new \Exception("O campo (numero_casa) não pode ser vazio", Response::HTTP_BAD_REQUEST);
        }

    }
}