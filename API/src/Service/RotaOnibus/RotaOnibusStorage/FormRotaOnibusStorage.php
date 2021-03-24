<?php


namespace App\Service\RotaOnibus\RotaOnibusStorage;


use App\Entity\Rota;
use App\Entity\RotaOnibus;
use Doctrine\ORM\EntityManager;

class FormRotaOnibusStorage
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(RotaOnibus $rota_onibus = null)
    {
        if ($rota_onibus){
            $this->em->persist($rota_onibus);
            $this->em->flush();
        }

        return $rota_onibus;
    }

    public function remove(RotaOnibus $rota_onibus = null)
    {
        if ($rota_onibus){
            $this->em->remove($rota_onibus);
            $this->em->flush();
        }

        return $rota_onibus;
    }
}