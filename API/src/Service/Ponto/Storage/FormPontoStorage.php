<?php


namespace App\Service\Ponto\Storage;


use App\Entity\Ponto;
use Doctrine\ORM\EntityManager;

class FormPontoStorage
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(Ponto $ponto = null)
    {
        if ($ponto){
            $this->em->persist($ponto);
            $this->em->flush();
        }

        return $ponto;
    }

    public function remove(Ponto $ponto = null)
    {
        if ($ponto){
            $this->em->remove($ponto);
            $this->em->flush();
        }

        return $ponto;
    }

    public function getPontoPorId($id)
    {
        $pontoRepository = $this->em->getRepository(Ponto::class);
        $ponto = $pontoRepository->find($id);

        return is_null($ponto) ? [] : $ponto->jsonSerialize();
    }
}