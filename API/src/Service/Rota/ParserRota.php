<?php


namespace App\Service\Rota;


use App\Entity\Rota;

class ParserRota
{
    public function setRotaFromData($dadosJson, Rota $rota)
    {
        $rota->setNome($dadosJson->nome);
        $rota->setCidade($dadosJson->cidade);

        return $rota;
    }
}