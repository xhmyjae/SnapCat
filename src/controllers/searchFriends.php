<?php

namespace App\Controllers\Friends\SearchFriend;

require_once('src/model/friends.php');

use App\Model\Friends\Friends;
use App\Model\Friends\FriendsRepository;
use App\Model\User\User;
use App\Model\User\UserRepository;
use RuntimeException;
use function App\Lib\Utils\redirect;

class SearchFriend {
    public function execute(User $input, array $input2): void
    {
        if (!isset($input->id) || !isset($input2['user_id'])) {
            throw new RuntimeException('Invalid input');
        }
        $user = (new UserRepository())->getUserById($input2['user_id']);
        (new FriendsRepository())->searchFriend($input->id, $user->id);
        redirect('/homepage');
    }
}