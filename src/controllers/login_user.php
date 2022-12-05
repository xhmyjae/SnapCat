<?php

namespace App\Controllers\User\Login;

require_once('src/model/user.php');

use App\Model\User\User;
use App\Model\User\UserRepository;
use RuntimeException;
use function App\Lib\Utils\redirect;

class LoginUser {
    public function execute(array $input): void
    {
        if (!isset($input['ids'], $input['password'])) {
            throw new RuntimeException('Invalid input');
        }

        $user = (new UserRepository())->loginUser($input['ids'], $input['password']);
        if ($user !== null) {
            $_SESSION['user_id'] = $user->id;
            redirect('/homepage');
        }
    }
}