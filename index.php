<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/login.php');
require_once('src/controllers/create_user.php');
require_once('src/controllers/create_post.php');
require_once('src/controllers/login_user.php');

use App\Controllers\Homepage\Homepage;
use App\Controllers\Login\Login;
use App\Controllers\post\Create\Create_Post;
use App\Controllers\User\Create\CreateUser;
use App\Controllers\User\Login\LoginUser;

$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
$uri = $uri[1];

try {
    switch ($uri) {
        case 'create_post':
            $createPost = new Create_Post();
            $createPost->execute($_POST);
            break;
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
        case 'login':
            $login = new LoginUser();
            $login->execute($_POST);
            break;
        default:
            throw new Exception('Page not found');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

