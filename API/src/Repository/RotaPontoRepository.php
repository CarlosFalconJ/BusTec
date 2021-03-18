<?php

namespace App\Repository;

use App\Entity\RotaPonto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RotaPonto|null find($id, $lockMode = null, $lockVersion = null)
 * @method RotaPonto|null findOneBy(array $criteria, array $orderBy = null)
 * @method RotaPonto[]    findAll()
 * @method RotaPonto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RotaPontoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RotaPonto::class);
    }

    // /**
    //  * @return RotaPonto[] Returns an array of RotaPonto objects
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
    public function findOneBySomeField($value): ?RotaPonto
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
