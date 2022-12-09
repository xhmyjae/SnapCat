<?php

namespace App\Controllers\Homepage;

use App\Lib\Database\DatabaseConnection;
use App\Model\Friends\FriendsRepository;
use App\Model\User\User;
use PDO;


class PostRepository
{
    public PDO $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }


    public function createPost(string $message, int $user_id, int $emotion): void
    {
        $statement = $this->databaseConnection->prepare('INSERT INTO posts (message, user_id, emotion) VALUES (:message, :user_id, :emotion)');
        $statement->execute(compact('message', 'user_id', 'emotion'));
    }

    function getPosts(): array
    {
        $statement = $this->databaseConnection->prepare('SELECT message, user_id FROM posts INNER JOIN users ON posts.user_id = users.id');
        $statement->execute();
        $posts = $statement->fetchAll();
        return $posts;
    }

    function getPostsbyFriend(User $connected_user): array
    {
        $statement = $this->databaseConnection->prepare('SELECT p.* FROM posts p JOIN friends f ON p.user_id = f.user_id1 OR p.user_id = f.user_id2 WHERE f.user_id1 = " '.$connected_user->id.' " OR f.user_id2 = " '.$connected_user->id.' " AND f.accepted = 1');
        $statement->execute();
        $postsFriends = $statement->fetchAll();
        return $postsFriends;
    }

    function getUserPost(User $connected_user): array {
        $statement = $this->databaseConnection->prepare('SELECT * FROM posts WHERE user_id = " '.$connected_user->id.' "');
        $statement->execute();
        return $statement->fetchAll();
    }

}

