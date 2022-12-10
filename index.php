<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/login.php');
require_once('src/controllers/create_user.php');
require_once('src/controllers/create_post.php');
require_once 'src/controllers/delete_post.php';
require_once('src/controllers/getPosts.php');
require_once('src/controllers/login_user.php');
require_once('src/controllers/profil.php');
require_once('src/controllers/logout_user.php');
require_once('src/controllers/get_connected_user.php');
require_once('src/controllers/getFriendsPost.php');
require_once('src/lib/utils.php');
require_once('src/controllers/update_user.php');
require_once('src/controllers/go_settings.php');
require_once('src/controllers/add_friend.php');
require_once('src/controllers/delete_friend.php');
require_once('src/controllers/is_friend.php');
require_once 'src/controllers/create_comment.php';
require_once('src/model/post.php');
require_once('src/model/comments.php');

use App\Controllers\comment\Create\Create_Comment;
use App\Controllers\Homepage\Homepage;
use App\Controllers\Login\Login;
use App\Controllers\post\Create\Create_Post;
use App\Controllers\post\Delete\delete_Post;
use App\Controllers\post\GetFriendsPosts\get_FriendsPosts;
use App\Controllers\User\Create\CreateUser;
use App\Controllers\User\GetConnected\GetConnectedUser;
use App\Controllers\User\Login\LoginUser;
use App\Controllers\User\Profil\ProfilUser;
use App\Controllers\User\Logout\LogoutUser;
use App\Controllers\User\Update\UpdateUser;
use App\Controllers\Settings\Settings;
use App\Controllers\Friends\AddFriend\AddFriend;
use App\Controllers\Friends\DeleteFriend\DeleteFriend;
use function App\Lib\Utils\redirect;

$uri_segments = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$first_segment = $uri_segments[1] ?? '';

session_start();

try {
    global $error;
    $error = false;

    global $connected_user;
    $connected_user = (new GetConnectedUser())->execute($_SESSION);

    $method = $_SERVER['REQUEST_METHOD'] ?? '';

    if ($connected_user === null && $first_segment !== '' && $method === 'GET') {
        redirect('/');
    }


    if ($connected_user !== null) {
        $_SESSION['end'] = time() + 3600;
        if (time() > $_SESSION['end']) {
            session_destroy();
        }
    }

    switch ($first_segment) {
        case 'profile':
            $ProfileUser = new ProfilUser();
            $ProfileUser->execute($_GET, $connected_user);
            break;
        case 'create_post':
            $createPost = new Create_Post();
            $emotion = $_POST['emotion'] ?? 1;
            $createPost->execute($_POST, $connected_user, $emotion);
            break;
        case 'create_comment':
            $post_id = $_POST['post_id'] ?? 0;
            $createComment = new Create_Comment();
            $createComment->execute($_POST, $connected_user, $post_id);
            break;
        case 'delete_post':
            $post_id = (int)$_POST['post_id'];
            $deletePost = new delete_Post();
            $deletePost->execute($post_id, $connected_user);
            redirect('/');
            break;
        case 'homepage':
            global $friends_posts;
            $friends_posts = (new get_FriendsPosts())->execute($connected_user);
            $homepage = new Homepage($connected_user);
            $homepage->execute($connected_user);
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
        case 'logout':
            $logout = new LogoutUser();
            $logout->execute($_SESSION);
            break;
        case 'settings-page':
            $settings_page = new Settings();
            $settings_page->execute();
            break;
        case 'settings':
            $update = new UpdateUser();
            $update->execute($_POST, $_SESSION);
            break;
        case 'addfriend':
            $add_friend = new AddFriend();
            $add_friend->execute($connected_user, $_GET);
            break;
        case 'deletefriend':
            $delete_friend = new DeleteFriend();
            $delete_friend->execute($connected_user, $_GET);
            break;
        default:
            redirect('/homepage');
    }
} catch (Exception $e) {
    echo $e->getMessage();
}

