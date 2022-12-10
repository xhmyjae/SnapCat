<?php

namespace App\Controllers\comment\Create;

require_once('src/model/comments.php');

use App\Controllers\Homepage\PostRepository;
use App\Model\Homepage\HomepageController;

use App\Model\comments\Create\CreateComment;
use App\Model\User\User;
use RuntimeException;
use function App\Lib\Utils\redirect;

class Create_Comment {
    public function execute(array $input, User $connected_user, int $post_id): void
    {
        if (!isset($input['message']))
            throw new RuntimeException('Invalid input');
        (new PostRepository())->createComment($input['message'], $connected_user->id, $post_id);
        redirect('/homepage');
    }
}
