<?php


namespace App\Service\UserMobile;


use App\Entity\User;
use App\Entity\UserMobile;
use App\Service\UserMobile\UserMobileStorage\FormUserMobileStorage;

class RegraCadastrarUserMobile
{
    private $storage;

    public function setUserMobilestorage(FormUserMobileStorage $storage)
    {
        $this->storage = $storage;
    }

    public function cadastrar(UserMobile $user)
    {
        $user_info = [];

        $this->storage->save($user);
        $user_info = $user->toArray();

        return $user_info;
    }
}