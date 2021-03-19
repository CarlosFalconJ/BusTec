<?php


namespace App\Service\Onibus\Storage;


use App\Entity\Onibus;
use Doctrine\ORM\EntityManager;

class FormOnibusStorage
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(Onibus $onibus = null)
    {
        if ($onibus){
            $this->em->persist($onibus);
            $this->em->flush();
        }

        return $onibus;
    }

    public function remove(Onibus $onibus = null)
    {
        if ($onibus){
            $this->em->remove($onibus);
            $this->em->flush();
        }

        return $onibus;
    }

    public function getOnibusPorId($id)
    {
        $onibusRepository = $this->em->getRepository(Onibus::class);
        $onibus = $onibusRepository->find($id);

        return is_null($onibus) ? [] : $onibus->jsonSerialize();
    }
}