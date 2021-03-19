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

    public function save(Rota $onibus = null)
    {
        if ($onibus){
            $this->em->persist($onibus);
            $this->em->flush();
        }

        return $onibus;
    }

    public function remove(Rota $onibus = null)
    {
        if ($onibus){
            $this->em->remove($onibus);
            $this->em->flush();
        }

        return $onibus;
    }

    public function getRotaPorId($id)
    {
        $rotaRepository = $this->em->getRepository(Rota::class);
        $rota = $rotaRepository->find($id);

        return is_null($rota) ? [] : $rota->jsonSerialize();
    }
}