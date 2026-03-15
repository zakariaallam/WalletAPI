<?php

namespace App\Actions;

use App\Repository\Interfaces\UserRepoInterface;
use App\Repository\UserRepo;

class CreateUserAction{

   public function __construct(private UserRepoInterface $userRepo){}

    public function createUser($data){
      
      return $this->userRepo->createUser($data);
    }
}