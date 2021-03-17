<?php


namespace App\Service\Aluno\Storage;


use App\Entity\Aluno;

class RegraApagarAluno
{

    private $storage;

    public function __construct(FormAlunoStorage $storage)
    {
        $this->storage = $storage;
    }

    public function apagar(Aluno $aluno = null)
    {
        $alunoInfo = null;

        $this->storage->remove($aluno);

        return $alunoInfo;
    }
}