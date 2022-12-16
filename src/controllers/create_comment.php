<?php

namespace App\Controllers\Comment\Create;

require_once('src/model/comments.php');

use App\Model\Comments\CommentRepository;
use App\Model\User\User;
use RuntimeException;
use function App\Lib\Utils\redirect;

class Create_Comment
{
    public function execute(array $input, User $connected_user): void
    {
        $message = $input['comment_content'] ?? '';

        if ($message === '') {
            throw new RuntimeException('Le message ne peut pas être vide');
        }

        (new CommentRepository())->createComment($message, $connected_user->id, (int)$input['post_id']);

        $logFile = fopen("log.txt", "a");
        if ($logFile === false) {
            echo "Error: Unable to open log file";
            exit;
        }

        $logEntry = "[".date("Y-m-d H:i:s")."] $connected_user->name a créé un commentaire\n";
        fwrite($logFile, $logEntry);

        fclose($logFile);
        redirect('/');
    }
}
