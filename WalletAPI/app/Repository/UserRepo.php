<?php

namespace App\Repository;

use App\DAO\UserDao;
use App\Repository\Interfaces\UserRepoInterface;

class UserRepo implements UserRepoInterface{
    
    public function __construct(private UserDao $userDao){}

    public function createUser(array $data)
    {
        return $this->userDao->createUser($data);
    }
}