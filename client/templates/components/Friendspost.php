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
<?php
foreach (array_slice($friends_posts, $offset, $length) as $post) {
$user_method = new GetUser();
$user = $user_method->execute($post['user_id']);
$post_comments = (new CommentRepository())->getComments($post['id']);
?>
<div class="post">
    <div class="post-content">
        <img alt="profile-picture" class="avatar" src="client/templates/img/<?= $user->avatar ?>.png">
        <div class="post-container">
            <div class="post-header">
                <p class="post-username"><?= $user->name ?></p>
                <p class="post-emotion"><?= $post['emotion'] == 1 ? ' 😄' : ($post['emotion'] == 2 ? ' 😔' : ($post['emotion'] == 3 ? ' 🤔' : ' 😭')) ?></p>
                <p class="post-date"><?= $post['creation_date'] ?></p>
                <?php if ($post['user_id'] == $connected_user->id) { ?>
                    <div class="delete-post">
                        <form action="/delete_post" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                            <button type="submit" class="delete-button form-btn" value="delete_post"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </div>
                <?php } ?>
            </div>
            <p class="post-message"><?= $post['message'] ?></p>
            <div class="post-footer">
                <div class="post-reactions">
                    <form action="/get_reactions" method="POST">
                        <input type="hidden" name="post_id" value="<?= $post['id'];?>">
                        <button type="submit" class="like-button form-btn" value="1">👍<span class="count"></span></button>
                        <button type="submit" class="dislike-button form-btn" value="2">👎<span class="count"></span></button>
                        <button type="submit" class="love-button form-btn" value="3">❤️<span class="count"></span></button>
                        <button type="submit" class="sad-button form-btn" value="4">😭<span class="count"></span></button>
                        <button type="submit" class="sad-button form-btn" value="5">😡<span class="count"></span></button>
                    </form>
                </div>
                <button class="comment-button <?= $post['id'];?>"><i class="fa-regular fa-comment"></i></button>
            </div>
        </div>
    </div>
    <div class="comments <?= $post['id'];?> hidden">
        <form class="write-comment-form" action="/create_comment" method="POST">
            <img alt="profile-picture" class="avatar" src="client/templates/img/<?= $connected_user->avatar ?>.png">
            <div class="write-comment-container">
                <input type="hidden" id="post-id" name="post_id" value="<?= $post['id']?>">
                <textarea class="input-post" id="comment-content" name="comment_content" placeholder="Write a comment..." required></textarea>
                <button type="submit" class="submit-comment-button" name="submit-comment" value="create_comment">Submit</button>
            </div>
        </form>
        <?php foreach ($post_comments as $comment) {
            $comment_user = $user_method->execute($comment['user_id']); ?>
            <div class="comment">
                <img alt="profile-picture" class="avatar" src="client/templates/img/<?= $comment_user->avatar ?>.png">
                <div class="comment-container">
                    <div class="comment-header">
                        <p class="comment-username"><?= $comment_user->name ?></p>
                        <p class="comment-date"><?= $comment['creation_date'] ?></p>
                    </div>
                    <p class="comment-content"><?= $comment['message'] ?></p>
                </div>
                <?php if ($comment['user_id'] == $connected_user->id) { ?>
                    <div class="delete-comment">
                        <form action="/delete_comment" method="POST">
                            <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                            <button type="submit" class="delete-button form-btn" value="delete_comment"><i class="fa-solid fa-trash-can"></i></button>
                        </form>
                    </div>
                <?php } ?>
                <form class="comment-votes-form" action="/comment_votes" method="POST">
                    <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                    <button type="submit" class="comment-up-button form-btn" value="1"><i class="fa-solid fa-chevron-up"></i></button>
                    <span class="comment-votes"><?= $comment['vote'] ?></span>
                    <button type="submit" class="comment-down-button form-btn" value="2"><i class="fa-solid fa-chevron-down"></i></button>
                </form>
            </div>
        <?php } ?>
    </div>
</div>
<?php } ?>