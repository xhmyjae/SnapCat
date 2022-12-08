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


    public function createPost(string $message, int $user_id): void
    {
        $emotion = 1;
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
        $friends = (new FriendsRepository())->getFriends($connected_user->id);
        $statement = $this->databaseConnection->prepare('SELECT message, user_id FROM posts
        INNER JOIN users ON posts.user_id = users.id
        INNER JOIN friends ON users.id = friends.user_id1 OR users.id = friends.user_id2');
        //$statement = $this->databaseConnection->prepare('SELECT message, user_id FROM posts INNER JOIN users ON posts.user_id = users.id WHERE users.id IN (SELECT friend_id FROM friends WHERE user_id = user_id)')
        $statement->execute();
        $postsFriends = $statement->fetchAll();
        return $postsFriends;
    }

}

