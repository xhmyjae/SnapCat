<?php

namespace App\Controllers\post\GetPosts;

require_once('src/model/post.php');

use App\Controllers\Homepage\PostRepository;
//use App\Model\Homepage\HomepageController;
//
//use App\Model\post\Create\getPosts;
use RuntimeException;

class get_Posts {
    public function execute(): array
    {
        $posts = (new PostRepository())->getPosts();
        return $posts;
    }
}
