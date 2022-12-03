<?php

namespace App\Controllers\User\Create;

require_once('src/model/user.php');

use App\Model\User\UserRepository;

class CreateUser {
    public function execute(string $name, string $mail, string $password): void
    {
        (new UserRepository())->createUser($name, $mail, $password);
    }
}