<?php

require_once('src/controllers/homepage.php');
require_once('src/controllers/login.php');
require_once('src/controllers/create_user.php');
require_once('src/controllers/create_post.php');
require_once('src/controllers/postPicture.php');
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
require_once('src/controllers/searchFriends.php');
require_once 'src/controllers/create_comment.php';
require_once 'src/controllers/delete_comment.php';
require_once('src/model/post.php');
require_once('src/model/comments.php');
require_once('src/model/reactions.php');
require_once('src/controllers/add_reaction.php');
require_once('src/controllers/add_vote.php');
require_once('src/model/votes.php');

use App\Controllers\Comment\Create\Create_Comment;
use App\Controllers\Comment\Delete\Delete_Comment;
use App\Controllers\Friends\AddFriend\AddFriend;
use App\Controllers\Friends\DeleteFriend\DeleteFriend;
use App\Controllers\Homepage\Homepage;
use App\Controllers\Login\Login;
use App\Controllers\post\Create\Create_Post;
use App\Controllers\post\Create\Post_Picture;
use App\Controllers\post\Delete\delete_Post;
use App\Controllers\post\GetFriendsPosts\get_FriendsPosts;
use App\Controllers\Settings\Settings;
use App\Controllers\User\Create\CreateUser;
use App\Controllers\User\GetConnected\GetConnectedUser;
use App\Controllers\User\Login\LoginUser;
use App\Controllers\User\Logout\LogoutUser;
use App\Controllers\User\Profil\ProfilUser;
use App\Controllers\User\Update\UpdateUser;
use App\Controllers\Friends\SearchFriend\SearchFriend;
use function App\Lib\Utils\redirect;
use App\Controllers\Reactions\AddReaction\AddReaction;
use App\Controllers\Votes\AddVote\AddVote;

$uri_segments = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$first_segment = $uri_segments[1] ?? '';


session_start();

try {
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
            $logFile = fopen("log.txt", "a");
            if ($logFile === false) {
                echo "Error: Unable to open log file";
                exit;
            }

            $logEntry = "[".date("Y-m-d H:i:s")."] $connected_user->name a regardé un profil\n";
            fwrite($logFile, $logEntry);
            fclose($logFile);
            break;
        case 'create_post':
            $createPost = new Create_Post();
            $createPost->execute($_POST, $connected_user);
            break;
        case 'add_reactions':
            $addReaction = new AddReaction();
            $addReaction->execute($connected_user, $_POST);
            break;
        case 'comment_votes':
            $addVote = new AddVote();
            $addVote->execute($connected_user, $_POST);
            break;
        case 'create_comment':
            $createComment = new Create_Comment();
            $createComment->execute($_POST, $connected_user);
            break;
        case 'delete_comment':
            $deleteComment = new Delete_Comment();
            $deleteComment->execute($_POST, $connected_user);
            break;
        case 'delete_post':
            $logFile = fopen("log.txt", "a");
            if ($logFile === false) {
                echo "Error: Unable to open log file";
                exit;
            }

            $logEntry = "[".date("Y-m-d H:i:s")."] $connected_user->name a supprimé un post\n";
            fwrite($logFile, $logEntry);

            fclose($logFile);
            $post_id = (int)$_POST['post_id'];
            $deletePost = new delete_Post();
            $deletePost->execute($post_id, $connected_user);
            redirect('/');

            break;
        case 'homepage':
            global $friends_posts;
            global $length;
            $friends_posts = (new get_FriendsPosts())->execute($connected_user);
            $homepage = new Homepage($connected_user);
            $homepage->execute($connected_user, $_GET);
            $logFile = fopen("log.txt", "a");
            if ($logFile === false) {
                echo "Error: Unable to open log file";
                exit;
            }

            $logEntry = "[".date("Y-m-d H:i:s")."] $connected_user->name se balade dans la homepage\n";
            fwrite($logFile, $logEntry);

            fclose($logFile);
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
            $logFile = fopen("log.txt", "a");
            if ($logFile === false) {
                echo "Error: Unable to open log file";
                exit;
            }

            $logEntry = "[".date("Y-m-d H:i:s")."] $connected_user->name a changé ces paramètres\n";
            fwrite($logFile, $logEntry);

            fclose($logFile);
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

