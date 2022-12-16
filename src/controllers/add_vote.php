<?php

namespace App\Controllers\Votes\AddVote;

require_once('src/model/votes.php');

use App\Abstract\FlashMessage;
use function App\Lib\Utils\redirect;
use App\Model\Votes\VotesRepository;
use App\Model\User\User;

class AddVote extends FlashMessage
{
    public function execute(User $connected_user, array $post): void
    {
        if (!isset($connected_user->id) || !isset($post['comment_id']) || !isset($post['vote'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/homepage');
        }
        $votesRepository = new VotesRepository();
        // check if the user has already voted to the comment
        // if user clicked on the same vote, delete the vote
        $voteUsers = $votesRepository->getVoteUsers($post['vote'], $post['comment_id']);
        foreach ($voteUsers as $voteUser) {
            if ($voteUser['user_id'] === $connected_user->id) {
                $votesRepository->deleteVote($post['comment_id'], $connected_user->id);
                redirect('/homepage');
            }
        }
        $votesRepository->deleteVote($post['comment_id'], $connected_user->id);
        // add the vote
        $votesRepository->addVote($post['vote'], $post['comment_id'], $connected_user->id);
        $logFile = fopen("log.txt", "a");
        if ($logFile === false) {
            echo "Error: Unable to open log file";
            exit;
        }
        $logEntry = "[".date("Y-m-d H:i:s")."] $connected_user->name a ajouté un vote\n";
        fwrite($logFile, $logEntry);
        fclose($logFile);
        redirect('/homepage');
    }
}