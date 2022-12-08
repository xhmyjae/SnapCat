<?php

namespace App\Controllers\Homepage;

use App\Lib\Database\DatabaseConnection;
use PDO;


class PostRepository
{
    public PDO $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }


    public function createPost(string $message, int $user_id): void
    {
        $emotion = 1;
        $statement = $this->databaseConnection->prepare('INSERT INTO posts (message, user_id, emotion) VALUES (:message, :user_id, :emotion)');
        $statement->execute(compact('message', 'user_id', 'emotion'));
    }

    function getPosts() : array {
        $statement = $this->databaseConnection->prepare('SELECT message, user_id FROM posts INNER JOIN users ON posts.user_id = users.id');
        $statement->execute();
        $posts = $statement->fetchAll();
        return $posts;
    }
}

