<?php

namespace App\Model\User;

require_once('src/lib/DatabaseConnection.php');

use App\Lib\Database\DatabaseConnection;
use PDO;

class User
{
    public int $id;
    public string $name;
    public string $mail;
    public string $avatar;
    public string $password;
    public string $creation_date;
    public ?string $description;
}

class UserRepository
{
    public PDO $databaseConnection;

    public function __construct() {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }

    public function createUser(string $name, string $mail, string $password): void {
        $avatar = "avatar image";

        $statement = $this->databaseConnection->prepare('INSERT INTO users (name, mail, avatar, password) VALUES (:name, :mail, :avatar, :password)');
        $statement->execute(compact('name', 'mail', 'password', 'avatar'));

        require_once('client/templates/homepage.php');
    }

    public function checkUserAvailability(string $name, string $mail): bool {
        $result = $this->databaseConnection->prepare("SELECT * FROM users WHERE (name = :name OR mail = :mail)");
        $result->execute(compact('name', 'mail'));
        $count = $result->rowCount();
        if ($count == 0) {
            return true;
        }
        return false;
    }
}