<?php


namespace App\Service\UserPontoFavorito;


use App\Entity\RotaOnibus;
use App\Entity\UsuarioPontosFavoritos;
use App\Service\RotaOnibus\RotaOnibusStorage\FormRotaOnibusStorage;
use App\Service\UserPontoFavorito\UserPontoFavoritoStorage\FormUserPontoFavoritoStorage;

class RegraCadastrarUserPontoFavorito
{
    private $storage;

    public function setRotaStorage(FormUserPontoFavoritoStorage $storage)
    {
        $this->storage = $storage;
    }

    public function cadastrar(UsuarioPontosFavoritos $user_pontoF)
    {
        $user_pontoF_info = [];

        $this->storage->save($user_pontoF);
        $user_pontoF_info = $user_pontoF->jsonSerialize();

        return $user_pontoF_info;
    }
}