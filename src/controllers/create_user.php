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
        $result = (new UserRepository())->checkUserAvailability($input['name'], $input['mail']);
        if ($result) {
            (new UserRepository())->createUser($input['name'], $input['mail'], $input['password']);
        } else {
            $this->setFlashes('error', 'Cet utilisateur existe déjà.');
            redirect('/');
        }
    }
}