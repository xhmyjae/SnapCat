<?php

namespace App\Controllers\User\GetConnected;

require_once('src/model/user.php');

use App\Model\User\User;
use App\Model\User\UserRepository;
use RuntimeException;

class GetConnectedUser {
    public function execute(array $input): ?User
    {
        if (!isset($input['user_id'])) {
            return null;
        }
        return (new UserRepository())->getUserById($input['user_id']);
    }
}