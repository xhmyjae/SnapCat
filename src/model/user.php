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
        // checks if user already exist
        $result = $this->query("SELECT * FROM users WHERE name = :name OR mail = :mail");
        if ($result->num_rows == 0) {
            // create user
            $statement = $this->databaseConnection->prepare('INSERT INTO users (name, mail, avatar, password) VALUES (:name, :mail, :avatar, :password)');
            $statement->execute(compact('name', 'mail', 'password'));

            require_once('client/templates/homepage.php');
        } else {
            // user already exists
        }
    }
}