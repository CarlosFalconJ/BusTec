<?php


namespace App\Service\user;


use App\Entity\User;
use App\Service\user\UserStorage\FormUserStorage;

class RegraCadastrarUser
{
    private $storage;

    public function setUserstorage(FormUserStorage $storage)
    {
        $this->storage = $storage;
    }

    public function cadastrar(User $user)
    {
        $user_info = [];

        $this->storage->save($user);
        $user_info = $user->toArray();

        return $user_info;
    }
}