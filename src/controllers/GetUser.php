<?php

namespace App\Controllers\User\GetUser;

require_once('src/model/user.php');

use App\Model\User\User;
use App\Model\User\UserRepository;


class GetUser
{
    public function execute(int $user_id): User|bool
    {
        return (new UserRepository())->getUserbyID($user_id);
    }
}




