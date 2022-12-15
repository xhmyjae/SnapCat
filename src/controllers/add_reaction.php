<?php

namespace App\Controllers\Reactions\AddReaction;

require_once('src/model/reactions.php');

use App\Abstract\FlashMessage;
use function App\Lib\Utils\redirect;
use App\Model\Reactions\ReactionsRepository;
use App\Model\User\User;

class AddReaction extends FlashMessage
{
    public function execute(User $connected_user, array $post): void
    {
        if (!isset($connected_user->id) || !isset($post['post_id']) || !isset($post['emoji'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/homepage');
        }
        $reactionsRepository = new ReactionsRepository();
        // check if the user has already reacted to the post
        // if user clicked on the same emoji, delete the reaction
        $reactionUsers = $reactionsRepository->getReactionUsers($post['emoji'], $post['post_id']);
        foreach ($reactionUsers as $reactionUser) {
            if ($reactionUser['user_id'] === $connected_user->id) {
                $reactionsRepository->deleteReaction($post['post_id'], $connected_user->id);
                redirect('/homepage');
            }
        }
        $reactionsRepository->deleteReaction($post['post_id'], $connected_user->id);
        // add the reaction
        $reactionsRepository->addReaction($post['emoji'], $post['post_id'], $connected_user->id);
        redirect('/homepage');
    }
}