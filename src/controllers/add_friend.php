<?php

namespace App\Controllers\Friends\AddFriend;

require_once('src/model/friends.php');

use App\Abstract\FlashMessage;
use App\Model\Friends\Friends;
use App\Model\Friends\FriendsRepository;
use App\Model\User\User;
use App\Model\User\UserRepository;
use RuntimeException;
use function App\Lib\Utils\redirect;

class AddFriend extends FlashMessage {
    public function execute(User $input, array $input2): void
    {
        if (!isset($input->id) || !isset($input2['user_id'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/homepage');
        }
        $user = (new UserRepository())->getUserById($input2['user_id']);
        (new FriendsRepository())->addFriend($input->id, $user->id);
        redirect('/homepage');
    }
}