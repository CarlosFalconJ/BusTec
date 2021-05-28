<?php


namespace App\Service\RotaPonto\RotaPontoStorage;


use App\Entity\RotaPonto;
use Doctrine\ORM\EntityManager;

class FormRotaPontoStorage
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(RotaPonto $rota_ponto = null)
    {
        if ($rota_ponto){
            $this->em->persist($rota_ponto);
            $this->em->flush();
        }

        return $rota_ponto;
    }

    public function remove(RotaPonto $rota_ponto = null)
    {
        if ($rota_ponto){
            $this->em->remove($rota_ponto);
            $this->em->flush();
        }

        return $rota_ponto;
    }

    public function getVinculoPorID($id)
    {
        $rotaPontoRepository = $this->em->getRepository(RotaPonto::class);
        $vinculo = $rotaPontoRepository->find($id);

        return is_null($vinculo) ? [] : $vinculo->jsonSerialize();
    }
}