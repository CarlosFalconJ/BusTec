<?php


namespace App\Service\RotaOnibus;


use App\Entity\RotaOnibus;
use App\Service\RotaOnibus\RotaOnibusStorage\FormRotaOnibusStorage;

class RegraApagarRotaOnibus
{

    public function __construct(FormRotaOnibusStorage $storage)
    {
        $this->storage = $storage;
    }

    public function apagar(RotaOnibus $rota_onibus = null)
    {
        $rota_onibus_Info = null;

        $this->storage->remove($rota_onibus);

        return $rota_onibus_Info;
    }
}