<?php


namespace App\Service\PontosFavoritosMobile;


use App\Entity\PontosFavoritosMobile;

class ParserPontoFavorito
{

    public function setPontoFromData($dadosJson, PontosFavoritosMobile $ponto)
    {
        $ponto->setNome($dadosJson->nome);

        return $ponto;
    }
}