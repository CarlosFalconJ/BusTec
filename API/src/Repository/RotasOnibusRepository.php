<?php

namespace App\Repository;

use App\Entity\RotaOnibus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RotaOnibus|null find($id, $lockMode = null, $lockVersion = null)
 * @method RotaOnibus|null findOneBy(array $criteria, array $orderBy = null)
 * @method RotaOnibus[]    findAll()
 * @method RotaOnibus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RotasOnibusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RotaOnibus::class);
    }

    // /**
    //  * @return RotaOnibus[] Returns an array of RotaOnibus objects
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
    public function findOneBySomeField($value): ?RotaOnibus
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
