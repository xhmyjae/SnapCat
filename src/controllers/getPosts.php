<?php

namespace App\Controllers\post\GetPosts;

require_once('src/model/post.php');
require_once('src/model/user.php');


use App\Controllers\Homepage\PostRepository;

class get_Posts
{
    public function execute(): array
    {
        return (new PostRepository())->getPosts();
    }
}
