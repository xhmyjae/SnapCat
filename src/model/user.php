<?php

namespace Application\Model\User;

require_once('src/lib/DatabaseConnection.php');

use Application\Lib\Database\DatabaseConnection;
use PDO;

class User {
    public int $id;
    public string $name;
    public string $mail;
    public string $avatar;
    public string $password;
    public string $creation_date;
    public ?string $description;
}

class UserRepository {
    public PDO $databaseConnection;

    public function __construct() {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }

    public function getUser(string $id): User|false {
        $statement = $this->databaseConnection->prepare('SELECT * FROM users WHERE id = :id');
        $statement->execute(compact('id'));
        return $statement->fetchObject(User::class);
    }

    public function getUsers(): array {
        return $this->databaseConnection->query('SELECT * FROM users ORDER BY id DESC')->fetchAll(PDO::FETCH_CLASS, User::class);
    }

    public function addUser(int $id, string $name, string $mail, string $avatar, string $password, string $creation_date, ?string $description): void {
        $statement = $this->databaseConnection->prepare('INSERT INTO users (id, name, mail, avatar, password, creation_date, description) VALUES (:id, :name, :mail, :avatar, :password, :creation_date, :description)');
        $statement->execute(compact('id', 'name', 'mail', 'avatar', 'password', 'creation_date', 'description'));
    }

    public function deleteUser(int $id): void {
        $statement = $this->databaseConnection->prepare('DELETE FROM users WHERE id = :id');
        $statement->execute(compact('id'));
    }
}