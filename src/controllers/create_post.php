<?php

namespace App\Controllers\post\Create;

require_once('src/model/post.php');

use App\Controllers\Homepage\PostRepository;
use App\Model\Homepage\HomepageController;

use App\Model\post\Create\CreatePost;
use RuntimeException;

class Create_Post {
    public function execute(array $input): void
    {
        if (!isset($input['message']))
            throw new RuntimeException('Invalid input');
        (new PostRepository())->createPost($input['message']);
    }
}
