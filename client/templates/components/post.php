<?php
global $posts;
use App\Controllers\User\GetUser\GetUser;
require_once 'src/controllers/GetUser.php';
?>



<?php
foreach ($posts as $post) {
    $user_method = new GetUser();
    $user = $user_method->execute($post['user_id']);

?>
    <div class="post">
        <div class="container">
            <div class="header-post">
                <div class="avatar-box">
                    <img alt="profile-picture" class="avatar" src="client/templates/img/<?= $user->avatar ?>.png">
                </div>
            </div>
            <div class="content-post">
                <p class="pseudo"> <?= $user->name ?> </p>
                <p class="content"><?= $post['message'] ?></p>
            </div>
        </div>
        <div class="react">
            <span>👍<p>199</p> </span>
            <span>👎<p>199</p></span>
            <span>❤<p>199</p></span>
            <span>😄<p>199</p></span>
            <span>😭<p>199</p></span>
            <span>💬<p>199</p></span>
        </div>
    </div>
<?php } ?>