<?php
global $posts;
global $post;

use App\Controllers\User\GetUser\GetUser;
use App\Model\Comments\CommentRepository;

require_once 'src/controllers/GetUser.php';
require_once 'src/model/comments.php';

if ($posts !== null) {
    foreach ($posts as $post) {
        $post_comments = (new CommentRepository())->getComments($post['id']); ?>
        <div class="post-profile">
            <div class="post-profile-container">
                <p class="post-profile-text"><?= $post['message'] ?></p>
            </div>
            <div class="post-profile-hover">
                <i class="fa-solid fa-heart"></i>
                <i class="fa-solid fa-comment"></i>
            </div>

            <dialog class="modal-background">
                <div class="modal-post">
                    <div class="modal-post-content">
                        <p class="modal-post-date"><?= $post['creation_date'] ?> <?= $post['emotion'] == 1 ? ' 😄' : ($post['emotion'] == 2 ? ' 😔' : ($post['emotion'] == 3 ? ' 🤔' : ' 😭')) ?></p>
                        <p class="modal-post-content-text"><?= $post['message'] ?></p>
                    </div>
                    <div class="modal-information">
                        <div class="modal-close">
                            <form action="/delete_post" method="POST">
                                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                <button type="submit" class="delete-button form-btn" value="delete_post"><i
                                            class="fa-solid fa-trash-can"></i></button>
                            </form>
                            <i class="fa-solid fa-xmark"></i>
                        </div>
                        <div class="modal-reactions">
                            <div class="modal-reaction">
                                <a href="" class="modal-reaction-icon"><i
                                            class="fa-solid fa-thumbs-up reaction-icon"></i>
                                    <p class="modal-reaction-number">222</p></a>
                            </div>
                            <div class="modal-reaction">
                                <a href="" class="modal-reaction-icon"><i
                                            class="fa-solid fa-thumbs-down reaction-icon"></i>
                                    <p class="modal-reaction-number">222</p></a>
                            </div>
                            <div class="modal-reaction">
                                <a href="" class="modal-reaction-icon"><i class="fa-solid fa-heart reaction-icon"></i>
                                    <p class="modal-reaction-number">222</p></a>
                            </div>
                            <div class="modal-reaction">
                                <a href="" class="modal-reaction-icon"><i class="fa-solid fa-star reaction-icon"></i>
                                    <p class="modal-reaction-number">222</p></a>
                            </div>
                            <div class="modal-reaction">
                                <a href="" class="modal-reaction-icon"><i class="fa-solid fa-star reaction-icon"></i>
                                    <p class="modal-reaction-number">222</p></a>
                            </div>
                        </div>
                        <div class="modal-comments">
                            <?php foreach ($post_comments as $comment) {
                                $comment_user = (new GetUser())->execute($comment['user_id']); ?>
                                <div class="modal-comment">
                                    <img class="modal-comment-avatar" src="../img/<?= $comment_user->avatar ?>.png"
                                         alt="comment avatar">
                                    <div class="modal-comment-content">
                                        <div class="modal-comment-information">
                                            <p class="modal-comment-name"><?= $comment_user->name ?></p>
                                            <p class="modal-comment-date"><?= $comment['creation_date'] ?></p>
                                        </div>
                                        <div class="modal-comment-text"><?= $comment['message'] ?></div>
                                    </div>
                                    <div class="modal-comment-votes">
                                        <i class="fa-solid fa-chevron-up"></i>
                                        <p class="modal-comment-votes-total"><?= $comment['vote'] ?></p>
                                        <i class="fa-solid fa-chevron-down"></i>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </dialog>
        </div>
    <?php } ?>
<?php } else {
    echo "Cet utilisateur n'a jamais rien envoyé ici...";
} ?>
