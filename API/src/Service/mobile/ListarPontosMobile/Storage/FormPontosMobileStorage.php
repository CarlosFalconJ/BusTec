<?php


namespace App\Service\mobile\ListarPontosMobile\Storage;


use App\Entity\Ponto;
use App\Entity\RotaPonto;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;

class FormPontosMobileStorage
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function listarPonto($id)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->select('p.id, p.nome, p.rua, p.bairro, rp.horario as horario')
            ->from(Ponto::class, 'p')
            ->innerJoin(RotaPonto::class, 'rp', 'WITH', ' rp.ponto = p.id' )
            ->where(
                $qb->expr()->eq('p.id', ':ponto')
            )->setParameter('ponto',$id, Type::INTEGER);

        $q = $qb->getQuery();

        try {
            $result = $q->getArrayResult();
        } catch (\Exception $e) {
            $result = [];
        }

        return $result;
    }
}