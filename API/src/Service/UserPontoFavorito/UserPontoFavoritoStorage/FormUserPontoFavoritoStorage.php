<?php


namespace App\Service\UserPontoFavorito\UserPontoFavoritoStorage;


use App\Entity\UsuarioPontosFavoritos;
use Doctrine\ORM\EntityManager;

class FormUserPontoFavoritoStorage
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(UsuarioPontosFavoritos $user_pontoF = null)
    {
        if ($user_pontoF){
            $this->em->persist($user_pontoF);
            $this->em->flush();
        }

        return $user_pontoF;
    }

    public function remove(UsuarioPontosFavoritos $user_pontoF = null)
    {
        if ($user_pontoF){
            $this->em->remove($user_pontoF);
            $this->em->flush();
        }

        return $user_pontoF;
    }

    public function getVinculoPorID($id)
    {
        $user_pontoF_repository = $this->em->getRepository(UsuarioPontosFavoritos::class);
        $vinculo = $user_pontoF_repository->find($id);

        return is_null($vinculo) ? [] : $vinculo->jsonSerialize();
    }
}