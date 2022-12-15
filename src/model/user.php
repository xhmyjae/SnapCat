<?php

namespace App\Model\User;

require_once('src/lib/DatabaseConnection.php');

use App\Lib\Database\DatabaseConnection;
use PDO;
use function App\Lib\Utils\redirect;
use function App\Lib\Utils\checkHash;

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

    public function __construct()
    {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }

    public function createUser(string $name, string $mail, string $password): void
    {
        // check if username is valid
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $name)) {
            require_once('client/templates/login.php');
        } else {
            $avatar = "catspaghetti";

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $statement = $this->databaseConnection->prepare('INSERT INTO users (name, mail, avatar, password) VALUES (:name, :mail, :avatar, :hash)');
            $statement->execute(compact('name', 'mail', 'hash', 'avatar'));

            redirect('/');
        }

    }

    public function checkUserAvailability(string $name, string $mail): bool
    {
        $result = $this->databaseConnection->prepare("SELECT * FROM users WHERE (name = :name OR mail = :mail)");
        $result->execute(compact('name', 'mail'));
        $count = $result->rowCount();
        if ($count == 0) {
            return true;
        }
        return false;
    }

    public function checkNameAvailability(string $name): bool
    {
        $result = $this->databaseConnection->prepare("SELECT * FROM users WHERE name = :name");
        $result->execute(compact('name'));
        $count = $result->rowCount();
        if ($count == 0) {
            return true;
        }
        return false;
    }

    public function checkMailAvailability(string $mail): bool
    {
        $result = $this->databaseConnection->prepare("SELECT * FROM users WHERE mail = :mail");
        $result->execute(compact('mail'));
        $count = $result->rowCount();
        if ($count == 0) {
            return true;
        }
        return false;
    }

    public function loginUser(string $ids, string $password): ?User
    {
        $result = $this->databaseConnection->prepare("SELECT * FROM users WHERE (name = :ids OR mail = :ids)");
        $result->execute(compact('ids'));
        $count = $result->rowCount();
        if ($count == 0) {
            return null;
        } else {
            $user = $result->fetchObject(User::class);
            $correctPassword = checkHash($password, $user->password);
            if ($correctPassword) {
                return $user;
            } else {
                return null;
            }
        }
    }

    public function getUserById(int $id): User|false
    {
        $statement = $this->databaseConnection->prepare('SELECT * FROM users WHERE id = :id');
        $statement->execute(compact('id'));
        return $statement->fetchObject(User::class);
    }

    public function updateUser(int $id, string $name, string $mail, string $avatar, string $password, string $description, string $confirm_password): void
    {
        $statement = $this->databaseConnection->prepare('UPDATE users SET name = :name, mail = :mail, avatar = :avatar, password = :password, description = :description WHERE id = :id AND password = :confirm_password');
        $statement->execute(compact('id', 'name', 'mail', 'avatar', 'password', 'description'));
    }

    public function updateName(int $id, string $name): void
    {
        $result = $this->databaseConnection->prepare("SELECT * FROM users WHERE name = :name");
        $result->execute(compact('name'));
        $count = $result->rowCount();
        if ($count == 0) {
            $statement = $this->databaseConnection->prepare('UPDATE users SET name = :name WHERE id = :id');
            $statement->execute(compact('id', 'name'));
        }
    }

    public function updateMail(int $id, string $mail): void
    {
        $result = $this->databaseConnection->prepare("SELECT * FROM users WHERE mail = :mail");
        $result->execute(compact('mail'));
        $count = $result->rowCount();
        if ($count == 0) {
            $statement = $this->databaseConnection->prepare('UPDATE users SET mail = :mail WHERE id = :id');
            $statement->execute(compact('id', 'mail'));
        }
    }

    public function updatePassword(int $id, string $password): void
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $statement = $this->databaseConnection->prepare('UPDATE users SET password = :hash WHERE id = :id');
        $statement->execute(compact('id', 'hash'));
    }

    public function updateBio(int $id, string $description): void
    {
        $statement = $this->databaseConnection->prepare('UPDATE users SET description = :description WHERE id = :id');
        $statement->execute(compact('id', 'description'));
    }

    public function updateAvatar(int $id, string $avatar): void
    {
        $statement = $this->databaseConnection->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
        $statement->execute(compact('id', 'avatar'));
    }

    public function searchFriend(string $search): array
    {
        $result = $this->databaseConnection->prepare('SELECT * FROM users WHERE name LIKE :search');
        $result->execute(['search' => "%$search%"]);
        return $result->fetchAll(PDO::FETCH_CLASS, User::class);
    }
}