<?php


namespace App\Service\user\UserStorage;


use App\Entity\User;
use Doctrine\ORM\EntityManager;

class FormUserStorage
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(User $user = null)
    {
        if ($user){
            $this->em->persist($user);
            $this->em->flush();
        }

        return $user;
    }

    public function remove(User $user = null)
    {
        if ($user){
            $this->em->remove($user);
            $this->em->flush();
        }

        return $user;
    }
}