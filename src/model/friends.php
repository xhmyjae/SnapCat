<?php

namespace Application\Model\Friend;

require_once('src/lib/DatabaseConnection.php');

use Application\Lib\Database\DatabaseConnection;
use PDO;

class Friend {
    public int $id;
    public int $user_id1;
    public int $user_id2;
    public bool $accepted;
}

class FriendRepository {
    public PDO $databaseConnection;

    public function __construct() {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }

    public function getFriends(): array {
        return $this->databaseConnection->query('SELECT * FROM friends ORDER BY id DESC')->fetchAll(PDO::FETCH_CLASS, Friend::class);
    }

    public function addFriend(int $id, string $user_id1, string $user_id2, bool $accepted): void {
        $statement = $this->databaseConnection->prepare('INSERT INTO friends (id, user_id1, user_id2, accepted) VALUES (:id, :user_id1, :user_id2, :accepted)');
        $statement->execute(compact('id', 'user_id1', 'user_id2', 'accepted'));
    }

    public function deleteFriend(int $id): void {
        $statement = $this->databaseConnection->prepare('DELETE FROM friends WHERE id = :id');
        $statement->execute(compact('id'));
    }
}