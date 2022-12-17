<?php

namespace App\Model\Comments;

use App\Lib\Database\DatabaseConnection;
use App\Model\User\User;
use PDO;

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

    public function deleteComment(int $comment_id, User $connected_user): void
    {
        $user_id = $connected_user->id;

        // delete all votes of the comment
        $statement = $this->databaseConnection->prepare('DELETE FROM votes WHERE comment_id = :comment_id');
        $statement->execute(compact('comment_id'));

        $statement = $this->databaseConnection->prepare('DELETE FROM comments WHERE id = :comment_id AND user_id = :user_id');
        $statement->execute(compact('comment_id', 'user_id'));
    }

    public function countComments(int $post_id): int
    {
        $statement = $this->databaseConnection->prepare('SELECT COUNT(*) FROM comments WHERE post_id = :post_id');
        $statement->execute(compact('post_id'));
        return $statement->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
    }
}
