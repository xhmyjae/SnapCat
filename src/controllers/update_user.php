<?php

namespace App\Controllers\User\Update;

require_once('src/model/user.php');

use App\Model\User\User;
use App\Model\User\UserRepository;
use RuntimeException;
use function App\Lib\Utils\redirect;

class UpdateUser {
    public function execute(array $input): void
    {
        // if y'a une value pour chaque post du form settings
    }
}