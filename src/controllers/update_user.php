<?php

namespace App\Controllers\User\Update;

require_once('src/model/user.php');

use App\Model\User\User;
use App\Model\User\UserRepository;
use RuntimeException;
use function App\Lib\Utils\redirect;

class UpdateUser {
    public function execute(array $input, array $session): void
    {
        if (!isset($session['user_id'])) {
            throw new RuntimeException('User is not connected');
        }

        var_dump($input);

        if (!empty($input['name']) && !empty($input['confirm-password'])) {
            (new UserRepository())->updateName($session['user_id'], $input['name'], $input['confirm-password']);
        }

        if (!empty($input['mail']) && !empty($input['confirm-password'])) {
            (new UserRepository())->updateMail($session['user_id'], $input['mail'], $input['confirm-password']);
        }

        if (!empty($input['password']) && !empty($input['confirm-password'])) {
            (new UserRepository())->updatePassword($session['user_id'], $input['password'], $input['confirm-password']);
        }

        if (!empty($input['bio']) && !empty($input['confirm-password'])) {
            (new UserRepository())->updateBio($session['user_id'], $input['bio'], $input['confirm-password']);
        }

        redirect('/homepage');

    }
}