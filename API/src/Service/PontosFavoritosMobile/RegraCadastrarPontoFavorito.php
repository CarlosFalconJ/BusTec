<?php


namespace App\Service\PontosFavoritosMobile;


use App\Entity\PontosFavoritosMobile;
use App\Entity\UserMobile;
use App\Service\mobile\ListarPontosMobile\Storage\FormPontosMobileStorage;
use App\Service\PontosFavoritosMobile\Storage\FormPontoFavoritoStorage;
use App\Service\PontosFavoritosMobile\Validation\PontoFavoritoValidation;

class RegraCadastrarPontoFavorito
{
    private $storage;

    public function setPontoFavoritoStorage(FormPontoFavoritoStorage $storage)
    {
        $this->storage = $storage;
    }

    public function cadastrar(PontosFavoritosMobile $pontosFavoritosMobile)
    {
        $pontosFavoritosMobile_info = [];

        $this->storage->save($pontosFavoritosMobile);
        $pontosFavoritosMobile_info = $pontosFavoritosMobile->jsonSerialize();

        return $pontosFavoritosMobile_info;
    }
}