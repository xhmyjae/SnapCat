<?php

namespace App\Model\Friends;

require_once('src/lib/DatabaseConnection.php');

use App\Lib\Database\DatabaseConnection;
use http\QueryString;
use PDO;
use function App\Lib\Utils\redirect;

class Friends
{
    public int $id;
    public int $user_id1;
    public int $user_id2;
    public bool $accepted;

}

class FriendsRepository{

    public PDO $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }

        public function getFriends(int $user_id): array
        {
            $result = $this->databaseConnection->prepare("SELECT * FROM friends WHERE (user_id1 = :user_id OR user_id2 = :user_id) AND accepted = 1");
            $result->execute(compact('user_id'));
            // get all users that are friends with the current user
            $friends = $result->fetchAll(PDO::FETCH_CLASS, Friends::class);
            $friends_id = [];
            foreach ($friends as $friend) {
                if ($friend->user_id1 === $user_id) {
                    $friends_id[] = $friend->user_id2;
                } else {
                    $friends_id[] = $friend->user_id1;
                }
            }
            $friends_id = implode(',', $friends_id);
            if (empty($friends_id)) {
                return [];
            }
            $result = $this->databaseConnection->prepare("SELECT * FROM users WHERE id IN ($friends_id)");
            $result->execute();
            return $result->fetchAll(PDO::FETCH_CLASS, Friends::class);
        }

        public function getFriendRequests(int $user_id): array
        {
            $result = $this->databaseConnection->prepare("SELECT * FROM friends WHERE user_id2 = :user_id AND accepted = 0");
            $result->execute(compact('user_id'));
            //get all users that want to be friends with the current user
            $friends = $result->fetchAll(PDO::FETCH_CLASS, Friends::class);
            $friends_id = [];
            foreach ($friends as $friend) {
                $friends_id[] = $friend->user_id1;
            }
            $friends_id = implode(',', $friends_id);
            if (empty($friends_id)) {
                return [];
            }
            $result = $this->databaseConnection->prepare("SELECT * FROM users WHERE id IN ($friends_id)");
            $result->execute();
            return $result->fetchAll(PDO::FETCH_CLASS, Friends::class);
        }

        public function getSentFriendRequests(int $user_id): array
        {
            $result = $this->databaseConnection->prepare("SELECT * FROM friends WHERE user_id1 = :user_id AND accepted = 0");
            $result->execute(compact('user_id'));
            //get all users that want to be friends with the current user
            $friends = $result->fetchAll(PDO::FETCH_CLASS, Friends::class);
            $friends_id = [];
            foreach ($friends as $friend) {
                $friends_id[] = $friend->user_id2;
            }
            $friends_id = implode(',', $friends_id);
            if (empty($friends_id)) {
                return [];
            }
            $result = $this->databaseConnection->prepare("SELECT * FROM users WHERE id IN ($friends_id)");
            $result->execute();
            return $result->fetchAll(PDO::FETCH_CLASS, Friends::class);
        }

        public function addFriend(int $user_id1, int $user_id2): void
        {
            $asrequested = $this->databaseConnection->prepare("SELECT * FROM friends WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2) OR (user_id2 = :user_id1 AND user_id1 = :user_id2) AND accepted = 0");
            $asrequested->execute(compact('user_id1', 'user_id2'));
            $count = $asrequested->rowCount();
            if ($count == 1) {
                $result = $this->databaseConnection->prepare("UPDATE friends SET accepted = 1 WHERE(user_id1 = :user_id1 AND user_id2 = :user_id2) OR (user_id2 = :user_id1 AND user_id1 = :user_id2)");
                $result->execute(compact('user_id1', 'user_id2'));
            } else {
                $result = $this->databaseConnection->prepare("INSERT INTO friends (user_id1, user_id2, accepted) VALUES (:user_id1, :user_id2, 0)");
                $result->execute(compact('user_id1', 'user_id2'));
            }
        }

        public function deleteFriend(int $user_id1, int $user_id2): void
        {
            $result = $this->databaseConnection->prepare("DELETE FROM friends WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2) OR (user_id1 = :user_id2 AND user_id2 = :user_id1)");
            $result->execute(compact('user_id1', 'user_id2'));
        }

        public function isFriend(int $user_id1, int $user_id2): bool
        {
            $result = $this->databaseConnection->prepare("SELECT * FROM friends WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2) OR (user_id1 = :user_id2 AND user_id2 = :user_id1) AND accepted = 1");
            $result->execute(compact('user_id1', 'user_id2'));
            $friend = $result->fetchObject(Friends::class);
            if ($friend) {
                return true;
            }
            return false;
        }


        public function hasRequested(int $user_id1, int $user_id2): bool
        {
            $result = $this->databaseConnection->prepare("SELECT * FROM friends WHERE (user_id1 = :user_id1 AND user_id2 = :user_id2) OR (user_id1 = :user_id2 AND user_id2 = :user_id1) AND accepted = 0");
            $result->execute(compact('user_id1', 'user_id2'));
            $friend = $result->fetchObject(Friends::class);
            if ($friend) {
                return true;
            }
            return false;
        }


}

