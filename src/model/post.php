<?php

namespace Application\Model\Post;

require_once('src/lib/DatabaseConnection.php');

use Application\Lib\Database\DatabaseConnection;
use PDO;

class Post {
    public int $id;
    public string $message;
    public string $creation_date;
    public int $user_id;
    public ?string $picture;
    public int $emotion;

    public function get_emotion(): string {
        return match ($this->emotion) {
            1 => "triste",
            2 => "heureux",
            3 => "énervé",
            4 => "géné",
            5 => "Bing Bong",
        };
    }
}

class PostRepository {
    public PDO $databaseConnection;

    public function __construct() {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }

    public function getPost(string $id): Post|false {
        $statement = $this->databaseConnection->prepare('SELECT * FROM posts WHERE id = :id');
        $statement->execute(compact('id'));
        return $statement->fetchObject(Post::class);
    }

    public function getPosts(): array {
        return $this->databaseConnection->query('SELECT * FROM posts ORDER BY id DESC')->fetchAll(PDO::FETCH_CLASS, Post::class);
    }

    public function addPost(int $id, string $message, string $creation_date, int $user_id, ?string $picture, int $emotion): void {
        $statement = $this->databaseConnection->prepare('INSERT INTO posts (id, message, creation_date, user_id, picture, emotion) VALUES (:id, :message, :creation_date, :user_id, :picture, :emotion)');
        $statement->execute(compact('id', 'message', 'creation_date', 'user_id', 'picture', 'emotion'));
    }

    public function deletePost(int $id): void {
        $statement = $this->databaseConnection->prepare('DELETE FROM posts WHERE id = :id');
        $statement->execute(compact('id'));
    }
}