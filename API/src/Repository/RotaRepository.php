<?php

namespace App\Repository;

use App\Controller\BustecAdm\RotasRender;
use App\Entity\Onibus;
use App\Entity\Ponto;
use App\Entity\Rota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Rota|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rota|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rota[]    findAll()
 * @method Rota[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RotaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rota::class);
    }

    // /**
    //  * @return Rota[] Returns an array of Rota objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rota
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function buscarTodasRotas()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('r.id, r.nome, r.cidade')
            ->from(Rota::class, 'r');

        return $qb->getQuery()->getArrayResult();
    }

    public function buscarRotasNomeID()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('r.id, r.nome')
            ->from(Rota::class, 'r');

        return $qb->getQuery()->getArrayResult();
    }

    public function buscarOnibusPlacaID()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('o.id, o.placa')
            ->from(Onibus::class, 'o');

        return $qb->getQuery()->getArrayResult();
    }

    public function buscaPontosNomeID()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('p.id, p.nome')
            ->from(Ponto::class, 'p');

        return $qb->getQuery()->getArrayResult();
    }
}
