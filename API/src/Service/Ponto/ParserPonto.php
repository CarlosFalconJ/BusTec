<?php


namespace App\Service\Ponto;


use App\Entity\Ponto;

class ParserPonto
{
    public function setPontoFromData($dadosJson, Ponto $ponto)
    {
        $ponto->setNome($dadosJson->nome);
        $ponto->setBairro($dadosJson->bairro);
        $ponto->setRua($dadosJson->rua);
        $ponto->setPontoReferencia($dadosJson->ponto_referencia);
        $ponto->setNumero($dadosJson->numero);

        return $ponto;
    }
}