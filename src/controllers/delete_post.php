<?php

namespace App\Controllers\post\Delete;

use App\Controllers\Homepage\PostRepository;
use App\Model\User\User;

class delete_Post
{
    public function execute(int $post_id, User $connected_user): void
    {
        (new PostRepository())->deletePost($post_id, $connected_user);
    }
}