<?php

namespace App\Controllers\Homepage;
require_once 'src/model/friends.php';
use App\Model\Friends\Friends;
use App\Model\Friends\FriendsRepository;
use App\Model\User\User;
use App\Model\User\UserRepository;
use RuntimeException;

class Homepage
{

    public function execute(User $connected_user, ?array $search): void
    {
        global $friends;
        global $friend_requests;
        global $friend_requests_sent;
        global $all_users;
        $friend_requests_sent = (new FriendsRepository())->getSentFriendRequests($connected_user->id);
        $friend_requests = (new FriendsRepository())->getFriendRequests($connected_user->id);
        $friends = (new FriendsRepository())->getFriends($connected_user->id);
        if (isset($search) && !empty($search['search'])) {
            $all_users = (new UserRepository())->searchFriend($search['search']);
        }
        require_once ('client/templates/homepage.php');
    }
}
