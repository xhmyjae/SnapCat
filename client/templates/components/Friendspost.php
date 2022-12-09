<?php
global $friends_posts;

use App\Controllers\User\GetUser\GetUser;
require_once 'src/controllers/getFriendsPost.php';
require_once 'src/controllers/GetUser.php';


?>



<?php
foreach ($friends_posts as $post) {
    $user_method = new GetUser();
    $user = $user_method->execute($post['user_id']);

?>
    <div class="post">
        <div class="container">
            <div class="header-post">
                <div class="avatar-box">
                    <img alt="profile-picture" class="avatar" src="client/templates/img/<?= $user->avatar ?>.png">
                </div>
            <div class="content-post">
                <div class="post-header">
                    <p class="pseudo"> <?= $user->name ?> </p>
                    <p class="date"> <?= $post['creation_date'] ?> </p>
                    <p class="emotion"> <?=   $post['emotion'] == 1 ? ' 😄' : ($post['emotion'] == 2 ? ' 😔' : ($post['emotion'] == 3 ? ' 🤔' : ' 😭')) ?></p>
                    <?php if ($post['user_id'] == $_SESSION['user_id']) { ?>
                    <div class="delete-post">
                        <form action="delete_post" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <button type="submit" class="delete-button" value="delete_post">X</button>
                        </form>
                    </div>
                    <?php } ?>
                </div>
                <p class="content"><?= $post['message'] ?></p>
            </div>
        </div>
        <div class="react">
            <span>👍<p>0</p> </span>
            <span>👎<p>0</p></span>
            <span>❤<p>0</p></span>
            <span>😄<p>0</p></span>
            <span>😭<p>0</p></span>
            <span>💬<p>0</p></span>
        </div>
    </div>
<?php } ?>