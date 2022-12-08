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


    public function createPost(string $message): void
    {
        $user_id = 1;
        $emotion = 1;
        $statement = $this->databaseConnection->prepare('INSERT INTO posts (message, user_id, emotion) VALUES (:message, :user_id, :emotion)');
        $statement->execute(compact('message', 'user_id', 'emotion'));
    }

    function getPosts() : array {
        $statement = $this->databaseConnection->prepare('SELECT message, user_id FROM posts');
        $statement->execute();
        $posts = $statement->fetchAll();
        return $posts;
    }
}

