<?php


namespace App\Service\RotaPonto;


use App\Entity\RotaPonto;
use App\Service\RotaPonto\RotaPontoStorage\FormRotaPontoStorage;

class RegraApagarRotaPonto
{

    public function __construct(FormRotaPontoStorage $storage)
    {
        $this->storage = $storage;
    }

    public function apagar(RotaPonto $rota_ponto = null)
    {
        $rota_ponto_Info = null;

        $this->storage->remove($rota_ponto);

        return $rota_ponto_Info;
    }
}