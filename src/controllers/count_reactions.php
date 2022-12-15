<?php

namespace App\Controllers\Reactions\CountReactions;

require_once('src/model/reactions.php');

use App\Abstract\FlashMessage;
use function App\Lib\Utils\redirect;
use App\Model\Reactions\ReactionsRepository;
use App\Model\User\User;

class CountReactions extends FlashMessage
{
    public function execute(User $connected_user, array $post): int
    {
        if (!isset($connected_user->id) || !isset($post['post_id']) || !isset($post['emoji'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/homepage');
        }
        global $reactionsCount;
        $reactionsCount = new ReactionsRepository();
        $reactionsCount->countReaction($post['emoji'], $post['post_id']);
        redirect('/homepage');
    }
}