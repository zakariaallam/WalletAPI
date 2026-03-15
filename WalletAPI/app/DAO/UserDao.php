<?php

namespace App\DAO;

use App\Models\User;

class UserDao{

    public function createUser($data){
        $user = User::create($data);
        $token =$user->createToken('token')->plainTextToken;
        return [
            'user' => $user,
            'token' => $token
        ];
    }
}