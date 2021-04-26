<?php

namespace App\Repository;

use App\Entity\Aluno;
use App\Entity\Onibus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\Type;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method Aluno|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aluno|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aluno[]    findAll()
 * @method Aluno[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlunoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aluno::class);
    }

    // /**
    //  * @return Aluno[] Returns an array of Aluno objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aluno
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function buscarTodosOnibus()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('o.id, o.placa')
            ->from(Onibus::class, 'o');

        return $qb->getQuery()->getArrayResult();
    }


    public function buscarTodosAlunos()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('a.id, a.nome, a.email, a.numero_contato, a.ra, a.bairro, a.rua, a.numero_casa, o.placa')
            ->from(Aluno::class, 'a')->leftJoin(Onibus::class, 'o', 'with', 'a.onibus = o.id');

        return $qb->getQuery()->getArrayResult();

    }
}
