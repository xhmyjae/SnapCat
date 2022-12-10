<?php

namespace App\Controllers\User\Profil;

require_once('src/model/user.php');

use App\Abstract\FlashMessage;
use App\Controllers\Homepage\PostRepository;
use App\Model\Friends\FriendsRepository;
use App\Model\User\User;
use App\Model\User\UserRepository;
use function App\Lib\Utils\redirect;

class ProfilUser extends FlashMessage
{
    public function execute(array $input, User $connected_user): void
    {
        if (!isset($input['user_id'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/homepage');
        }

        global $user;
        $user = (new UserRepository())->getUserById($input['user_id']);

        if (!$user) {
            $this->setFlashes('error', 'Cet utilisateur n\'existe pas.');
            redirect('/homepage');
        }

        global $posts;
        $posts = (new PostRepository())->getUserPost($user);
        global $is_friend;
        $is_friend = (new FriendsRepository())->isFriend($user->id, $connected_user->id);
        global $has_requested;
        $has_requested = (new FriendsRepository())->hasRequested($user->id, $connected_user->id);

        require_once('client/templates/base_profil.php');
    }

}
