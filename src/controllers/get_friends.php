<?php

namespace App\Controllers\Friends\GetFriends;

require_once('src/model/friends.php');

use App\Model\Friends\Friends;
use App\Model\Friends\FriendsRepository;
use RuntimeException;
use function App\Lib\Utils\redirect;

class GetFriends {
    public function execute(array $input): ?array
    {
        if (!isset($input['id'])) {
            throw new RuntimeException('Invalid input');
        }

        $friends = (new FriendsRepository())->getFriends($input['id']);
        return $friends;
    }
}