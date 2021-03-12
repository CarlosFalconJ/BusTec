<?php

namespace App\Repository;

use App\Entity\Onibus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Onibus|null find($id, $lockMode = null, $lockVersion = null)
 * @method Onibus|null findOneBy(array $criteria, array $orderBy = null)
 * @method Onibus[]    findAll()
 * @method Onibus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OnibusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Onibus::class);
    }

    // /**
    //  * @return Onibus[] Returns an array of Onibus objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Onibus
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
