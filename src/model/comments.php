<?php

namespace App\Model\comments;

use App\Lib\Database\DatabaseConnection;
use App\Model\Friends\FriendsRepository;
use App\Model\User\User;
use PDO;
use RuntimeException;

require_once('src/lib/DatabaseConnection.php');


class CommentRepository
{
    public PDO $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }

    public function createComment(string $message, int $user_id, int $post_id): void
    {
        $statement = $this->databaseConnection->prepare('INSERT INTO comments (message, user_id, post_id) VALUES (:message, :user_id, :post_id)');
        $statement->execute(compact('message', 'user_id', 'post_id'));
    }
}
