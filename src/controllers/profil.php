<?php

namespace App\Controllers\User\Profil;

require_once('src/model/user.php');

use App\Model\Friends\FriendsRepository;
use App\Model\User\User;
use App\Model\User\UserRepository;

class ProfilUser
{
    public function execute(array $input, User $connected_user): void
    {
        if (!isset($input['user_id'])) {
            throw new \RuntimeException("user not found");
        }

        global $user;
        $user = (new UserRepository())->getUserById($input['user_id']);

        global $is_friend;
        $is_friend = (new FriendsRepository())->isFriend($user->id, $connected_user->id);

        require_once('client/templates/base_profil.php');
    }
}
