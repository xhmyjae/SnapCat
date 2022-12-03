<?php

namespace App\Controllers\User\Create;

require_once('src/model/user.php');

use App\Model\User\UserRepository;
use http\Exception\RuntimeException;

class CreateUser {
    public function execute(array $input): void
    {
        if (!isset($input['name'], $input['mail'], $input['password'])) throw new RuntimeException('Invalid input');

        (new UserRepository())->createUser($input['name'], $input['mail'], $input['password']);
    }
}