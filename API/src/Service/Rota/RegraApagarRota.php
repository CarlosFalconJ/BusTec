<?php


namespace App\Service\Rota;


use App\Entity\Rota;
use App\Service\Rota\Storage\FormRotaStorage;

class RegraApagarRota
{
    private $storage;

    public function __construct(FormRotaStorage $storage)
    {
        $this->storage = $storage;
    }

    public function apagar(Rota $rota = null)
    {
        $rotaInfo = null;

        $this->storage->remove($rota);

        return $rotaInfo;
    }
}