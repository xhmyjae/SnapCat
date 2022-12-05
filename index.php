<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/login.php');
require_once('src/controllers/create_user.php');
require_once('src/controllers/create_post.php');
require_once('src/controllers/login_user.php');
require_once('src/controllers/profil.php');
require_once('src/controllers/get_connected_user.php');
require_once('src/lib/utils.php');

use App\Controllers\Homepage\Homepage;
use App\Controllers\Login\Login;
use App\Controllers\post\Create\Create_Post;
use App\Controllers\User\Create\CreateUser;
use App\Controllers\User\GetConnected\GetConnectedUser;
use App\Controllers\User\Login\LoginUser;
use App\Controllers\User\Profil\ProfilUser;
use function App\Lib\Utils\redirect;

$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', $uri);
$uri = $uri[1];

session_start();

try {
    global $connected_user;
    $connected_user = (new GetConnectedUser())->execute($_SESSION);

    if ($connected_user == null && $uri !== 'login') {
        $uri = '';
    }

    if ($connected_user != null) {
        $_SESSION['end'] = time() + 3600;
        if (time() > $_SESSION['end']) {
            session_destroy();
        }
    }

    switch ($uri) {
        case 'profile':
            $ProfileUser = new ProfilUser();
            $ProfileUser->execute();
            break;
        case 'create_post':
            $createPost = new Create_Post();
            $createPost->execute($_POST);
            break;
        case 'homepage':
            $homepage = new Homepage();
            $homepage->execute();
            break;
        case '':
            if ($connected_user !== null) {
                redirect('/homepage');
            }
            $login = new Login();
            $login->execute();
            break;
        case 'signup':
            if ($connected_user !== null) {
                redirect('/homepage');
            }
            $signup = new CreateUser();
            $signup->execute($_POST);
            break;
        case 'login':
            if ($connected_user !== null) {
                redirect('/homepage');
            }
            $login = new LoginUser();
            $login->execute($_POST);
            break;
        default:
            throw new Exception('Page not found');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

