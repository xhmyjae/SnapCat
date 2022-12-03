<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/login.php');
require_once('src/controllers/create_user.php');

use App\Controllers\Homepage\Homepage;
use App\Controllers\Login\Login;
use App\Controllers\User\Create\CreateUser;

$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
$uri = $uri[0];

try {
    switch ($uri) {
        case 'homepage':
            $homepage = new Homepage();
            $homepage->execute();
            break;
        case '':
            $login = new Login();
            $login->execute();
            break;
        case 'signup':
            $signup = new CreateUser();
            $signup->execute($_POST);
            break;
        default:
            throw new Exception('Page not found');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

