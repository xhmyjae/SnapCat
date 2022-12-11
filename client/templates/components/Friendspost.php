<?php
global $friends_posts;
global $connected_user;

$offset = 0;
$length = 5;

use App\Controllers\User\GetUser\GetUser;
use App\Model\Comments\CommentRepository;

require_once 'src/controllers/getFriendsPost.php';
require_once 'src/controllers/GetUser.php';
require_once 'src/model/comments.php';

?>

<script defer src="client/scripts/comment.js"></script>

<?php
foreach (array_slice($friends_posts, $offset, $length) as $post) {
    $user_method = new GetUser();
    $user = $user_method->execute($post['user_id']);
    $post_comments = (new CommentRepository())->getComments($post['id']);

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
            <form action="/create_comment" method="POST">
                <input type="hidden" id="post-id" name="post_id" value="<?= $post['id']?>">
                <textarea id="comment-content" name="comment_content" placeholder="Write a comment..." required></textarea>
                <button type="submit" class="submit-comment-button" name="submit-comment" value="create_comment">Submit</button>
            </form>
        </div>
        <?php foreach ($post_comments as $comment) {
            $comment_user = $user_method->execute($comment['user_id']); ?>
            <div class="comment">
                <div class="avatar-box">
                    <img alt="profile-picture" class="avatar" src="client/templates/img/<?= $comment_user->avatar ?>.png">
                </div>
                <div class="content-comment">
                    <p class="pseudo"> <?= $comment_user->name ?> </p>
                    <p class="content"><?= $comment['message'] ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
<?php } ?>