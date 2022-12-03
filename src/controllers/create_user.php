<?php

namespace App\Controllers\User\Create;

require_once('src/model/user.php');

use App\Model\User\UserRepository;
use RuntimeException;

class CreateUser {
    public function execute(array $input): void
    {
        if (!isset($input['name'], $input['mail'], $input['password']))
            throw new RuntimeException('Invalid input');

//        $result = $this->query("SELECT * FROM users WHERE name = :name OR mail = :mail");
//        if ($result->num_rows == 0) {
//            // create user
//            (new UserRepository())->createUser($input['name'], $input['mail'], $input['password']);
//
//            require_once('client/templates/homepage.php');
//        } else {
//            // user already exists
//        }
    }
}