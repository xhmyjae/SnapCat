<?php

namespace App\Model\Reactions;

use App\Lib\Database\DatabaseConnection;
use App\Model\User\User;
use PDO;

class Reaction {
    public int $id;
    public int $emoji;
    public int $post_id;
    public int $user_id;
}

class ReactionsRepository
{
    public PDO $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }

    public function addReaction(int $emoji, int $post_id, int $user_id): void
    {
        $statement = $this->databaseConnection->prepare('INSERT INTO reactions (emoji, post_id, user_id) VALUES (:emoji, :post_id, :user_id)');
        $statement->execute(compact('emoji', 'post_id', 'user_id'));
    }

    public function deleteReaction(int $post_id, int $user_id): void
    {
        $statement = $this->databaseConnection->prepare('DELETE FROM reactions WHERE post_id = :post_id AND user_id = :user_id');
        $statement->execute(compact('post_id', 'user_id'));
    }

    public function countReaction(int $emoji, int $post_id): int
    {
        $statement = $this->databaseConnection->prepare('SELECT COUNT(*) FROM reactions WHERE emoji = :emoji AND post_id = :post_id');
        $statement->execute(compact('emoji', 'post_id'));
        return $statement->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
    }

    public function getReactionUsers(int $emoji, int $post_id): array
    {
        $statement = $this->databaseConnection->prepare('SELECT user_id FROM reactions WHERE emoji = :emoji AND post_id = :post_id');
        $statement->execute(compact('emoji', 'post_id'));
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countComments(int $post_id): int
    {
        $statement = $this->databaseConnection->prepare('SELECT COUNT(*) FROM comments WHERE post_id = :post_id');
        $statement->execute(compact('post_id'));
        return $statement->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
    }

    public function countTotalReactions(int $post_id): int
    {
        $statement = $this->databaseConnection->prepare('SELECT COUNT(*) FROM reactions WHERE post_id = :post_id');
        $statement->execute(compact('post_id'));
        return $statement->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
    }
}