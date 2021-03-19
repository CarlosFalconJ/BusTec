<?php


namespace App\Service\Onibus;


use App\Entity\Onibus;
use App\Service\Onibus\Storage\FormOnibusStorage;

class RegraApagarOnibus
{
    private $storage;

    public function __construct(FormOnibusStorage $storage)
    {
        $this->storage = $storage;
    }

    public function apagar(Onibus $onibus = null)
    {
        $alunoInfo = null;

        $this->storage->remove($onibus);

        return $alunoInfo;
    }
}