<?php

namespace App\Controllers\User\Profil;

require_once('src/model/user.php');

use App\Model\User\User;
use App\Model\User\UserRepository;

class ProfilUser
{
    public function execute(): void
    {
        require_once('client/templates/base_profil.php');
    }
}
