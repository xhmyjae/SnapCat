<?php
<<<<<<< HEAD
namespace App\Controllers\Users\Login;

use Application\Model\Session\SessionRepository;

class LoginUser {
    public function execute(string $user_id): void {
        (new SessionRepository())->createSession($user_id);
=======

namespace App\Controllers\login;


class login
{

    public function execute()
    {
        require_once('client/templates/login.php');
>>>>>>> 34f62b128c148fc14a87badb814dc9da1e3c99fc
    }
}