<?php

namespace App\Controllers\comment\Create;

require_once('src/model/comments.php');

use App\Model\comments\CommentRepository;
use App\Model\Homepage\HomepageController;

use App\Model\User\User;
use RuntimeException;
use function App\Lib\Utils\redirect;

class Create_Comment {
    public function execute(array $input, User $connected_user, int $post_id): void
    {
        $message = $input['message'] ?? '';
        $user_id = $connected_user->id;

        if ($message === '') {
            throw new RuntimeException('Le message ne peut pas être vide');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->createComment($message, $user_id, $post_id);

        redirect('/');
    }
}
