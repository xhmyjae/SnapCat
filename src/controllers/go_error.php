<?php

namespace App\Controllers\Error;


class Error
{

    public function execute()
    {
        require_once('client/templates/error.php');
    }
}