<?php

namespace App\Controllers\Friends\IsFriend;

require_once('src/model/friends.php');

use App\Model\Friends\Friends;
use App\Model\Friends\FriendsRepository;
use App\Model\User\User;
use App\Model\User\UserRepository;
use RuntimeException;
use function App\Lib\Utils\redirect;

class IsFriend {
    public function execute(User $input, array $input2): void
    {
        if (!isset($input->id) || !isset($input2['user_id2'])) {
            throw new RuntimeException('Invalid input');
        }
        $user = (new UserRepository())->getUserById($input2['user_id2']);
        $friend = new Friends();
        $friend = (new FriendsRepository())->addFriend($input->id, $user->id);
        redirect('/homepage');
    }
}