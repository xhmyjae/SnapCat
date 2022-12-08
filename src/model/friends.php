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
        $result = $this->databaseConnection->prepare("SELECT * FROM friends WHERE (user_id1 = :user_id OR user_id2 = :user_id)");
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
        $result = $this->databaseConnection->prepare("SELECT * FROM users WHERE id IN ($friends_id)");
        $result->execute();
        return $result->fetchAll(PDO::FETCH_CLASS, Friends::class);
        }
}

