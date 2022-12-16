<?php

namespace App\Controllers\Comment\Delete;

require_once('src/model/comments.php');

use App\Model\Comments\CommentRepository;
use App\Model\User\User;
use RuntimeException;
use function App\Lib\Utils\redirect;

class Delete_Comment
{
    public function execute(array $input, User $connected_user): void
    {
        $comment_id = $input['comment_id'] ?? '';

        if ($comment_id === '') {
            throw new RuntimeException('Le commentaire n\'existe pas');
        }

        (new CommentRepository())->deleteComment((int)$comment_id, $connected_user);

        $logFile = fopen("log.txt", "a");
        if ($logFile === false) {
            echo "Error: Unable to open log file";
            exit;
        }

        $logEntry = "[".date("Y-m-d H:i:s")."] $connected_user->name a supprimé un commentaire\n";
        fwrite($logFile, $logEntry);

        fclose($logFile);
        redirect('/');
    }
}
