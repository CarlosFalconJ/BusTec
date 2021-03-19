<?php


namespace App\Service\Onibus;


use App\Entity\Onibus;

class ParserOnibus
{
    public function setOnibusFromData($dadosJson, Onibus $onibus)
    {
        $onibus->setPlaca($dadosJson->placa);
        $onibus->setMotoristaResponsavel($dadosJson->motorista_responsavel);

        return $onibus;
    }
}