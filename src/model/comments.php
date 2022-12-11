<?php

namespace App\Model\Comments;

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

    public function getComments(int $post_id): array
    {
        $statement = $this->databaseConnection->prepare('SELECT * FROM comments WHERE post_id = :post_id ORDER BY creation_date DESC');
        $statement->execute(compact('post_id'));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
