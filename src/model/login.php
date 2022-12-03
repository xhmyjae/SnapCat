<?php

namespace App\Controllers\Login;

require_once('src/model/post.php');

use Application\Model\Post\PostRepository;

class Login {
    public function execute(): void {
        global $posts;
        $posts = (new PostRepository())->getPosts();

        require('templates/homepage.php');
    }
}
