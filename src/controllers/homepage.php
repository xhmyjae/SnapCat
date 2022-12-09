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
        global $friend_requests;
        global $friend_requests_sent;
        $friend_requests_sent = (new FriendsRepository())->getSentFriendRequests($connected_user->id);
        $friend_requests = (new FriendsRepository())->getFriendRequests($connected_user->id);
        $friends = (new FriendsRepository())->getFriends($connected_user->id);
        require_once ('client/templates/homepage.php');
    }
}
