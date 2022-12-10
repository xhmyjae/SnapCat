<?php

namespace App\Controllers\User\Logout;

use App\Abstract\FlashMessage;
use RuntimeException;
use function App\Lib\Utils\redirect;

class LogoutUser extends FlashMessage {
    public function execute(array $input): void
    {
        if (!isset($input)) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/homepage');
        }

        session_destroy();
        redirect('/');
    }
}