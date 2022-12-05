<?php

namespace App\Controllers\User\Logout;

use RuntimeException;
use function App\Lib\Utils\redirect;

class LogoutUser {
    public function execute(array $input): void
    {
        if (!isset($input)) {
            throw new RuntimeException('Invalid input');
        }

        session_destroy();
        redirect('/');
    }
}