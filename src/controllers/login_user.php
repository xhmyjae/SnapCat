<?php

namespace App\Controllers\User\Login;

require_once('src/model/user.php');

use App\Model\User\User;
use App\Model\User\UserRepository;
use RuntimeException;

class LoginUser {
    public function execute(array $input): void
    {
        if (!isset($input['ids'], $input['password']))
            throw new RuntimeException('Invalid input');
        (new UserRepository())->loginUser($input['ids'], $input['password']);
    }
}