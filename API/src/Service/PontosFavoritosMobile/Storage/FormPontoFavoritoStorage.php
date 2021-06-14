<?php


namespace App\Service\PontosFavoritosMobile\Storage;


use App\Entity\PontosFavoritosMobile;
use App\Entity\UserMobile;
use Doctrine\ORM\EntityManager;

class FormPontoFavoritoStorage
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(PontosFavoritosMobile $pontosFavoritosMobile = null)
    {

        if ($pontosFavoritosMobile){
            $this->em->persist($pontosFavoritosMobile);
            $this->em->flush();
        }

        return $pontosFavoritosMobile;
    }

    public function remove(PontosFavoritosMobile $ponto_favorito = null)
    {
        if ($ponto_favorito){
            $this->em->remove($ponto_favorito);
            $this->em->flush();
        }

        return $ponto_favorito;
    }

    public function getPontoPorId($id)
    {
        $pontoRepository = $this->em->getRepository(PontosFavoritosMobile::class);
        $ponto = $pontoRepository->find($id);

        return is_null($ponto) ? [] : $ponto->jsonSerialize();
    }
}