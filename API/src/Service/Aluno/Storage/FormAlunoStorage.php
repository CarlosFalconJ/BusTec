<?php


namespace App\Service\Aluno\Storage;


use App\Entity\Aluno;
use Doctrine\ORM\EntityManager;

class FormAlunoStorage
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(Aluno $aluno = null)
    {
        if ($aluno){
            $this->em->persist($aluno);
            $this->em->flush();
        }

        return $aluno;
    }

    public function remove(Aluno $aluno = null)
    {
       if ($aluno){
           $this->em->remove($aluno);
           $this->em->flush();
       }

       return $aluno;
    }

    public function getAlunoPorId($id)
    {
        $alunoRepository = $this->em->getRepository(Aluno::class);
        $aluno = $alunoRepository->find($id);

        return is_null($aluno) ? [] : $aluno->jsonSerialize();
    }
}