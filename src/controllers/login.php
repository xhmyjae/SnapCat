<?php
namespace App\Controllers\Users\Login;

use Application\Model\Session\SessionRepository;

class LoginUser {
    public function execute(string $user_id): void {
        (new SessionRepository())->createSession($user_id);
    }
}