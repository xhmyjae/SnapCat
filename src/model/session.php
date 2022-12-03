<?php

namespace Application\Model\Session;

require_once('src/lib/DatabaseConnection.php');

use Application\Lib\Database\DatabaseConnection;
use PDO;

class Session {
    public string $key;
    public int $user_id;
}

class SessionRepository
{
    public PDO $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }

    public function getSessionByKey(string $key): Session|false
    {
        $statement = $this->databaseConnection->prepare('SELECT * FROM sessions WHERE key = :key');
        $statement->execute(compact('key'));
        return $statement->fetchObject(Session::class);
    }

    public function getSessionByUserId(string $user_id): Session|false {
        $statement = $this->databaseConnection->prepare('SELECT * FROM sessions WHERE user_id = :user_id');
        $statement->execute(compact('user_id'));
        return $statement->fetchObject(Session::class);
    }

    public function createSession(string $user_id) : string {
        $sql = $this->databaseConnection->prepare('SELECT * FROM sessions WHERE user_id = :user_id');
        $result =
        $key = bin2hex(random_bytes(32));
        $statement = $this->databaseConnection->prepare('INSERT INTO sessions (key, user_id) VALUES (:key, :user_id)');
        $statement->execute([
            'key' => $key,
            'user_id' => $user_id,
        ]);

        return $key;
    }


}

