<?php


namespace App\Service\Aluno;


use App\Entity\Aluno;
use App\Service\Aluno\Storage\FormAlunoStorage;

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