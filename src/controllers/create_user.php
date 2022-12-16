<?php

namespace App\Controllers\User\Create;

require_once('src/model/user.php');
require_once('src/abstract/FlashMessage.php');

use App\Abstract\FlashMessage;
use App\Model\User\UserRepository;
use function App\Lib\Utils\redirect;

class CreateUser extends FlashMessage
{
    public function execute(array $input): void
    {
        if (!isset($input['name'], $input['mail'], $input['password'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/');
        }
        $name = $input['name'];
        $result = (new UserRepository())->checkUserAvailability($input['name'], $input['mail']);

        $logFile = fopen("log.txt", "a");
        if ($logFile === false) {
            echo "Error: Unable to open log file";
            exit;
        }

        $logEntry = "[".date("Y-m-d H:i:s")."] $name vient juste de créer un compte\n";
        fwrite($logFile, $logEntry);

        fclose($logFile);
        if ($result) {
            (new UserRepository())->createUser($input['name'], $input['mail'], $input['password']);
        } else {
            $this->setFlashes('error', 'Cet utilisateur existe déjà.');
            redirect('/');
        }
    }
}