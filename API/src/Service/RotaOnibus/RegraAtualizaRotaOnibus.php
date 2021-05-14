<?php


namespace App\Service\RotaOnibus;


use App\Entity\RotaOnibus;
use App\Service\RotaOnibus\RotaOnibusStorage\FormRotaOnibusStorage;

class RegraAtualizaRotaOnibus
{
    private $storage;

    public function setRotaOnibusStorage(FormRotaOnibusStorage $storage)
    {
        $this->storage = $storage;
    }

    public function atualizar(RotaOnibus $rota_onibus)
    {
        $rota_onibus_info = [];

        $this->storage->save($rota_onibus);
        $rota_onibus_info = $rota_onibus->jsonSerialize();

        return $rota_onibus_info;
    }
}