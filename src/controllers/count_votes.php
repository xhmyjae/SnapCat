<?php

namespace App\Controllers\Votes\CountVotes;

require_once('src/model/votes.php');

use App\Abstract\FlashMessage;
use function App\Lib\Utils\redirect;
use App\Model\Votes\VotesRepository;
use App\Model\User\User;

class CountVotes extends FlashMessage
{
    public function execute(User $connected_user, array $post): int
    {
        if (!isset($connected_user->id) || !isset($post['comment_id']) || !isset($post['vote'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/homepage');
        }
        $votesRepository = new VotesRepository();
        $votesRepository->countVote($post['vote'], $post['comment_id']);
        redirect('/homepage');
    }
}