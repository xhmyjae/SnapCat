<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/login.php');

use App\Controllers\Homepage\Homepage;
use App\Controllers\Login\Login;


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
        default:
            throw new Exception('Page not found');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

