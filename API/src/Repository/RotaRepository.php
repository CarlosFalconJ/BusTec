<?php

namespace App\Repository;

use App\Controller\BustecAdm\RotasRender;
use App\Entity\Aluno;
use App\Entity\Onibus;
use App\Entity\Ponto;
use App\Entity\Rota;
use App\Entity\RotaOnibus;
use App\Entity\RotaPonto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Types\Type;
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

    public function buscarVinculosOnibus($rota)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('ro.id, r.nome, o.placa')
            ->from(Rota::class, 'r')
            ->innerJoin(RotaOnibus::class, 'ro','with', 'r.id = ro.rota')
            ->innerJoin(Onibus::class, 'o','with','ro.onibus = o.id')
            ->where(
                $qb->expr()->eq('r.id', ':rota')
            )->setParameter('rota' , $rota , Type::INTEGER);

        return $qb->getQuery()->getArrayResult();
    }

    public function buscarVinculosPonto($rota)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('rp.id, r.nome, p.nome as nome_ponto')
            ->from(Rota::class, 'r')
            ->innerJoin(RotaPonto::class, 'rp','with', 'r.id = rp.rota')
            ->innerJoin(Ponto::class, 'p', 'with','rp.ponto = p.id')
            ->where(
                $qb->expr()->eq('r.id', ':rota')
            )->setParameter('rota' , $rota , Type::INTEGER);

        return $qb->getQuery()->getArrayResult();
    }

    public function buscaTotalRotas()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();

        $qb->select('COUNT(r.id) as qtd_rotas')
            ->from(Rota::class, 'r');

        return $qb->getQuery()->getArrayResult();
    }

}
