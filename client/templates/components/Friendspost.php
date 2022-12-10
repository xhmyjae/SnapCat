<?php
global $friends_posts;

use App\Controllers\Homepage\PostRepository;
use App\Controllers\User\GetUser\GetUser;

require_once 'src/controllers/getFriendsPost.php';
require_once 'src/controllers/GetUser.php';


?>

<script defer src="client/scripts/comment.js"></script>

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
                    <p class="emotion"> <?= $post['emotion'] == 1 ? ' 😄' : ($post['emotion'] == 2 ? ' 😔' : ($post['emotion'] == 3 ? ' 🤔' : ' 😭')) ?></p>
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
            <form action="get_reactions" method="POST">
                <input type="hidden" name="post_id" value="<?= $post['id'];?>">
                <button type="submit" class="like-button" value="1">👍 <span class="count"></span></button>
                <button type="submit" class="dislike-button" value="2">👎 <span class="count"></span></button>
                <button type="submit" class="love-button" value="3">❤️ <span class="count"></span></button>
                <button type="submit" class="sad-button" value="4">😭 <span class="count"></span></button>
                <button type="submit" class="comment-button" value="5">💬 <span class="count"></span></button>
            </form>
        </div>
        <div class="comment-form" style="display: block;">
            <form action="create_comment" method="POST">
                <input type="hidden" id="post-id" value="<?= $post['id']?>">
                <input type="hidden" id="user-id" value="<?= $_SESSION['user_id'] ?>">
                <textarea id="comment-message" name="message" placeholder="Write a comment..." required></textarea>
                <button type="submit" class="submit-comment-button" value="create_comment">Submit</button>
            </form>
        </div>
    </div>
<?php } ?>