<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/login.php');
require_once('src/controllers/create_user.php');

use App\Controllers\Homepage\Homepage;
use App\Controllers\Login\Login;
use App\Controllers\User\Create\CreateUser;

$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
$uri = $uri[1];

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
            if (!isset($_POST['name'], $_POST['mail'], $_POST['password'])) throw new RuntimeException('Invalid input');

            $signup->execute($_POST['name'], $_POST['mail'], $_POST['password']);
            break;
        default:
            throw new Exception('Page not found');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

