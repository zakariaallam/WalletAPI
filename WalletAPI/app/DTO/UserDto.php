<?php

namespace App\DTO;

class UserDto {
    public function __construct(
        public string $name,
        public string $email,
        public string $id
        ){}
 
}
