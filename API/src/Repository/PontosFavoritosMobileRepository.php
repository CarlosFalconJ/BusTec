<?php

namespace App\Repository;

use App\Entity\PontosFavoritosMobile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PontosFavoritosMobile|null find($id, $lockMode = null, $lockVersion = null)
 * @method PontosFavoritosMobile|null findOneBy(array $criteria, array $orderBy = null)
 * @method PontosFavoritosMobile[]    findAll()
 * @method PontosFavoritosMobile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PontosFavoritosMobileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PontosFavoritosMobile::class);
    }

    // /**
    //  * @return PontosFavoritosMobile[] Returns an array of PontosFavoritosMobile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PontosFavoritosMobile
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
