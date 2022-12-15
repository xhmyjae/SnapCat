<?php

namespace App\Model\Votes;

use App\Lib\Database\DatabaseConnection;
use App\Model\User\User;
use PDO;

class Votes {
    public int $id;
    public int $vote;
    public int $comment_id;
    public int $user_id;
}

class VotesRepository
{
    public PDO $databaseConnection;

    public function __construct()
    {
        $this->databaseConnection = (new DatabaseConnection())->getConnection();
    }

    public function addVote(int $vote, int $comment_id, int $user_id): void
    {
        $statement = $this->databaseConnection->prepare('INSERT INTO votes (vote, comment_id, user_id) VALUES (:vote, :comment_id, :user_id)');
        $statement->execute(compact('vote', 'comment_id', 'user_id'));
    }

    public function deleteVote(int $comment_id, int $user_id): void
    {
        $statement = $this->databaseConnection->prepare('DELETE FROM votes WHERE comment_id = :comment_id AND user_id = :user_id');
        $statement->execute(compact('comment_id', 'user_id'));
    }

    public function countVote(int $vote, int $comment_id): int
    {
        $statement = $this->databaseConnection->prepare('SELECT COUNT(*) FROM votes WHERE vote = :vote AND comment_id = :comment_id');
        $statement->execute(compact('vote', 'comment_id'));
        return $statement->fetch(PDO::FETCH_ASSOC)['COUNT(*)'];
    }

    public function getVoteUsers(int $vote, int $comment_id): array
    {
        $statement = $this->databaseConnection->prepare('SELECT user_id FROM votes WHERE vote = :vote AND comment_id = :comment_id');
        $statement->execute(compact('vote', 'comment_id'));
        return $statement->fetchAll();
    }
}