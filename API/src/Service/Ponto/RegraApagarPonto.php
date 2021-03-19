<?php


namespace App\Service\Ponto;


use App\Entity\Ponto;
use App\Service\Ponto\Storage\FormPontoStorage;


class RegraApagarPonto
{
    private $storage;

    public function __construct(FormPontoStorage $storage)
    {
        $this->storage = $storage;
    }

    public function apagar(Ponto $ponto = null)
    {
        $pontoInfo = null;

        $this->storage->remove($ponto);

        return $pontoInfo;
    }
}