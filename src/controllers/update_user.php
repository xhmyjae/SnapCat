<?php

namespace App\Controllers\User\Update;

require_once('src/model/user.php');

use App\Abstract\FlashMessage;
use App\Model\User\UserRepository;
use function App\Lib\Utils\redirect;

class UpdateUser extends FlashMessage
{
    public function execute(array $input, array $session): void
    {

        if (!isset($session['user_id'])) {
            $this->setFlashes('error', 'Certains paramètres n\'ont pas été renseignés.');
            redirect('/settings-page');
        }

        $user = (new UserRepository())->getUserById($session['user_id']);

        if (!empty($input['name']) && !empty($input['confirm-password']) && ($user->name !== $input['name'])) {
            $available = (new UserRepository())->checkNameAvailability($input['name']);
            if (!$available) {
                $this->setFlashes('error', 'Ce nom d\'utilisateur est déjà utilisé.');
                redirect('/settings-page');
            }
            (new UserRepository())->updateName($session['user_id'], $input['name'], $input['confirm-password']);
        }

        if (!empty($input['mail']) && !empty($input['confirm-password']) && ($user->mail !== $input['mail'])) {
            $available = (new UserRepository())->checkMailAvailability($input['mail']);
            if (!$available) {
                $this->setFlashes('error', 'Cette adresse mail est déjà utilisée.');
                redirect('/settings-page');
            }
            (new UserRepository())->updateMail($session['user_id'], $input['mail'], $input['confirm-password']);
        }

        if (!empty($input['password']) && !empty($input['confirm-password'])) {
            (new UserRepository())->updatePassword($session['user_id'], $input['password'], $input['confirm-password']);
        }

        if (!empty($input['bio']) && !empty($input['confirm-password'])) {
            (new UserRepository())->updateBio($session['user_id'], $input['bio'], $input['confirm-password']);
        }

        if (!empty($input['avatar']) && !empty($input['confirm-password'])) {
            (new UserRepository())->updateAvatar($session['user_id'], $input['avatar'], $input['confirm-password']);
        }

        redirect("/profile?user_id=$session[user_id]");

    }
}