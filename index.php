<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/login.php');

use App\Controllers\Homepage\Homepage;
use App\Controllers\Login\Login;

<<<<<<< HEAD
=======

$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
$uri = $uri[1];

>>>>>>> 34f62b128c148fc14a87badb814dc9da1e3c99fc
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

