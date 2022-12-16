<?php

namespace App\Controllers\Friends\DeleteFriend;

require_once('src/model/friends.php');

use App\Abstract\FlashMessage;
use App\Model\Friends\FriendsRepository;
use App\Model\User\User;
use App\Model\User\UserRepository;
use function App\Lib\Utils\redirect;

class DeleteFriend extends FlashMessage
{
    public function execute(User $input, array $input2): void
    {
        if (!isset($input->id) || !isset($input2['user_id'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/homepage');
        }
        $user = (new UserRepository())->getUserById($input2['user_id']);
        (new FriendsRepository())->deleteFriend($input->id, $user->id);
        $logFile = fopen("log.txt", "a");
        if ($logFile === false) {
            echo "Error: Unable to open log file";
            exit;
        }
        $name = $user->name;

        $logEntry = "[".date("Y-m-d H:i:s")."] $name a supprimé un ami\n";
        fwrite($logFile, $logEntry);

        fclose($logFile);
        redirect('/homepage');
    }
}