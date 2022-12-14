<?php

namespace App\Controllers\User\Login;

require_once('src/model/user.php');

use App\Abstract\FlashMessage;
use App\Model\User\UserRepository;
use function App\Lib\Utils\redirect;

class LoginUser extends FlashMessage
{
    public function execute(array $input): void
    {
        if (!isset($input['ids'], $input['password'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/');
        }
        $logFile = fopen("log.txt", "a");
        if ($logFile === false) {
            echo "Error: Unable to open log file";
            exit;
        }
        $name = $input['ids'];

        $logEntry = "[".date("Y-m-d H:i:s")."] $name se connecte\n";
        fwrite($logFile, $logEntry);

        fclose($logFile);

        $user = (new UserRepository())->loginUser($input['ids'], $input['password']);
        if ($user !== null) {
            $_SESSION['user_id'] = $user->id;
            redirect('/homepage');
        } else {
            $this->setFlashes('error', 'Utilisateur ou mot de passe incorrect.');
            redirect('/');
        }
    }
}