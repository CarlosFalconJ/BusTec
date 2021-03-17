<?php


namespace App\Service\Aluno;


use App\Entity\Aluno;


use Doctrine\ORM\EntityManager;


class ParserAluno
{
    public function setAlunoFromData($dadosJson, Aluno $aluno)
    {

        $aluno->setNome($dadosJson->nome);
        $aluno->setNumeroContato($dadosJson->numero_contato);
        $aluno->setEmail($dadosJson->email);
        $aluno->setRa($dadosJson->ra);
        $aluno->setBairro($dadosJson->bairro);
        $aluno->setRua($dadosJson->rua);
        $aluno->setNumeroCasa($dadosJson->numero_casa);

        return $aluno;
    }
}