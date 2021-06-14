<?php


namespace App\Service\PontosFavoritosMobile\Storage;


use App\Entity\Ponto;
use App\Entity\PontosFavoritosMobile;
use App\Entity\UserMobile;
use App\Entity\UsuarioPontosFavoritos;
use Doctrine\DBAL\Types\Type;
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

    public function getPontoFavorito($id_user)
    {
        $qb = $this->em->createQueryBuilder();

        $qb = $qb->select('pf.id, pf.nome as ponto_favorito, p.nome')
            ->from(PontosFavoritosMobile::class, 'pf')
            ->innerJoin(Ponto::class, 'p', 'WITH', 'p.id = pf.ponto')
            ->innerJoin(UsuarioPontosFavoritos::class, 'upf', 'WITH', 'upf.ponto_favorito = pf.id')
            ->innerJoin(UserMobile::class, 'u', 'WITH', 'u.id = upf.usuario')
           ->where(
               $qb->expr()->eq('upf.usuario', ':user')
           )->setParameter('user' , $id_user , Type::INTEGER);

        return $qb->getQuery()->getArrayResult();
    }
}