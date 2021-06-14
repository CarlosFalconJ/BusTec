<?php

namespace App\Repository;

use App\Entity\UsuarioPontosFavoritos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsuarioPontosFavoritos|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsuarioPontosFavoritos|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsuarioPontosFavoritos[]    findAll()
 * @method UsuarioPontosFavoritos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioPontosFavoritosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsuarioPontosFavoritos::class);
    }

    // /**
    //  * @return UsuarioPontosFavoritos[] Returns an array of UsuarioPontosFavoritos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsuarioPontosFavoritos
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
