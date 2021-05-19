<?php


namespace App\Service\UserMobile\UserMobileStorage;


use App\Entity\User;
use App\Entity\UserMobile;
use Doctrine\ORM\EntityManager;

class FormUserMobileStorage
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function save(UserMobile $user = null)
    {
        if ($user){
            $this->em->persist($user);
            $this->em->flush();
        }

        return $user;
    }

    public function remove(UserMobile $user = null)
    {
        if ($user){
            $this->em->remove($user);
            $this->em->flush();
        }

        return $user;
    }
}