<?php

namespace App\Repository;

use App\Entity\Ponto;
use App\Entity\Rota;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ponto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ponto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ponto[]    findAll()
 * @method Ponto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PontoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ponto::class);
    }

    // /**
    //  * @return Ponto[] Returns an array of Ponto objects
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
    public function findOneBySomeField($value): ?Ponto
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function buscarTodosPontos()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('p.id, p.nome, p.bairro, p.rua, p.ponto_referencia, p.numero')
            ->from(Ponto::class, 'p');

        return $qb->getQuery()->getArrayResult();
    }

    public function buscaTotalPontos()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('COUNT(p.id) as qtd_pontos')
            ->from(Ponto::class, 'p');

        return $qb->getQuery()->getArrayResult();
    }
}
