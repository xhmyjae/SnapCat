<?php

namespace App\Controllers\Homepage;
require_once 'src/model/friends.php';
use App\Model\Friends\Friends;
use App\Model\Friends\FriendsRepository;
use App\Model\User\User;
use RuntimeException;

class Homepage
{

    public function execute(User $connected_user): void
    {
        global $friends;
        $friends = (new FriendsRepository())->getFriends($connected_user->id);
        require_once ('client/templates/homepage.php');
    }
}
