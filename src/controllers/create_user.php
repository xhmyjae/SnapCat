<?php

namespace App\Controllers\User\Create;

require_once('src/model/user.php');

use App\Model\User\UserRepository;
use RuntimeException;

class CreateUser {
    public function execute(array $input): void
    {
        if (!isset($input['name'], $input['mail'], $input['password']))
            $_SESSION['error'] = true;
            $result = (new UserRepository())->checkUserAvailability($input['name'], $input['mail']);
        if ($result) {
            unset($_SESSION['error']);
            (new UserRepository())->createUser($input['name'], $input['mail'], $input['password']);
        } else {
            $_SESSION['error'] = true;
        }
    }
}