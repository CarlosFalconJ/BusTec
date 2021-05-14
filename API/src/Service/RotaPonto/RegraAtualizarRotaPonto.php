<?php


namespace App\Service\RotaPonto;


use App\Entity\RotaPonto;
use App\Service\RotaPonto\RotaPontoStorage\FormRotaPontoStorage;

class RegraAtualizarRotaPonto
{
    private $storage;

    public function setRotaPontoStorage(FormRotaPontoStorage $storage)
    {
        $this->storage = $storage;
    }

    public function atualizar(RotaPonto $rota_ponto)
    {
        $rota_ponto_info = [];

        $this->storage->save($rota_ponto);
        $rota_ponto_info = $rota_ponto->jsonSerialize();

        return $rota_ponto_info;
    }
}