<?php

namespace App\Controllers\Homepage;

require_once('src/model/post.php');

use Application\Model\Post\PostRepository;

class Homepage {
    public function execute(): void {
        global $posts;
        $posts = (new PostRepository())->getPosts();

        require('templates/homepage.php');
    }

}
