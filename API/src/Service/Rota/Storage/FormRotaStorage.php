<?php


namespace App\Service\Rota\Storage;


use App\Entity\Rota;
use Doctrine\ORM\EntityManager;

class FormRotaStorage
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(Rota $rota = null)
    {
        if ($rota){
            $this->em->persist($rota);
            $this->em->flush();
        }

        return $rota;
    }

    public function remove(Rota $rota = null)
    {
        if ($rota){
            $this->em->remove($rota);
            $this->em->flush();
        }

        return $rota;
    }

    public function getRotaPorId($id)
    {
        $rotaRepository = $this->em->getRepository(Rota::class);
        $rota = $rotaRepository->find($id);

        return is_null($rota) ? [] : $rota->jsonSerialize();
    }
}