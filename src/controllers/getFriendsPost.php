<?php

namespace App\Controllers\post\GetFriendsPosts;

require_once('src/model/post.php');

use App\Controllers\Homepage\PostRepository;
use App\Model\User\User;

class get_FriendsPosts
{
    public function execute(User $connected_user): array
    {
        return (new PostRepository())->getPostsbyFriend($connected_user);
    }
}