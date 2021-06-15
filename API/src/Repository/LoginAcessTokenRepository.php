<?php

namespace App\Repository;

use App\Entity\LoginAcessToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method LoginAcessToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method LoginAcessToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method LoginAcessToken[]    findAll()
 * @method LoginAcessToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoginAcessTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LoginAcessToken::class);
    }

    // /**
    //  * @return LoginAcessToken[] Returns an array of LoginAcessToken objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LoginAcessToken
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
