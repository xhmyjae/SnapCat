<?php
global $posts;
global $post;

use App\Controllers\User\GetUser\GetUser;
use App\Model\Comments\CommentRepository;
use App\Model\Reactions\ReactionsRepository;
use App\Model\Votes\VotesRepository;

require_once 'src/controllers/GetUser.php';
require_once 'src/model/comments.php';
require_once 'src/model/reactions.php';
require_once 'src/controllers/count_reactions.php';
require_once 'src/controllers/count_votes.php';
?><script defer src="/client/scripts/write-post.js"></script><?php
if ($posts !== null) {
    foreach ($posts as $post) {
        $post_comments = (new CommentRepository())->getComments($post['id']); ?>
        <div class="post-profile">
            <div class="post-profile-container">
                <p class="post-profile-text"><?= $post['message'] ?></p>
            </div>
            <div class="post-profile-hover">
                <i class="fa-solid fa-heart">
                    <?php
                    $reactionsCount = new ReactionsRepository();
                    echo $reactionsCount->countTotalReactions($post['id']);
                    ?>
                </i>
                <i class="fa-solid fa-comment"></i>
            </div>

            <dialog class="modal-background">
                <div class="modal-post">
                    <div class="modal-post-content" <?php if ($post['picture'] != null) { ?> style="background: #282828 center no-repeat url('<?= $post['picture'] ?>');" <?php } ?>>
                        <p class="modal-post-date" <?php if ($post['picture'] != null) { ?> style="background: rgba(106, 107, 112, 0.5);" <?php } ?>><?= $post['creation_date'] ?> <?= $post['emotion'] == 1 ? ' 😄' : ($post['emotion'] == 2 ? ' 😔' : ($post['emotion'] == 3 ? ' 🤔' : ' 😭')) ?></p>
                        <p class="modal-post-content-text"<?php if ($post['picture'] != null) { ?> style="background: rgba(106, 107, 112, 0.5);" <?php } ?>><?= $post['message'] ?></p>
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
                            <form class="modal-form-reactions" action="/add_reactions" method="POST">
                                <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                                <div class="modal-reaction">
                                    <button type="submit" name="emoji" value="1" class="modal-reaction-icon">👍
                                        <p class="modal-reaction-number">
                                            <?php
                                            $reactionsCount = new ReactionsRepository();
                                            echo $reactionsCount->countReaction(1, $post['id']);
                                            ?>
                                        </p></button>
                                </div>
                                <div class="modal-reaction">
                                    <button type="submit" name="emoji" value="2" class="modal-reaction-icon">👎
                                        <p class="modal-reaction-number">
                                            <?php
                                            $reactionsCount = new ReactionsRepository();
                                            echo $reactionsCount->countReaction(2, $post['id']);
                                            ?>
                                        </p></button>
                                </div>
                                <div class="modal-reaction">
                                    <button type="submit" name="emoji" value="3" class="modal-reaction-icon">❤️
                                        <p class="modal-reaction-number">
                                            <?php
                                            $reactionsCount = new ReactionsRepository();
                                            echo $reactionsCount->countReaction(3, $post['id']);
                                            ?>
                                        </p></button>
                                </div>
                                <div class="modal-reaction">
                                    <button type="submit" name="emoji" value="4" class="modal-reaction-icon">😭
                                        <p class="modal-reaction-number">
                                            <?php
                                            $reactionsCount = new ReactionsRepository();
                                            echo $reactionsCount->countReaction(4, $post['id']);
                                            ?>
                                        </p></button>
                                </div>
                                <div class="modal-reaction">
                                    <button type="submit" name="emoji" value="5" class="modal-reaction-icon">😡
                                        <p class="modal-reaction-number">
                                            <?php
                                            $reactionsCount = new ReactionsRepository();
                                            echo $reactionsCount->countReaction(5, $post['id']);
                                            ?>
                                        </p></button>
                                </div>
                            </form>
                        </div>
                        <form class="modal-write-comment-form" action="/create_comment" method="POST">
                            <div class="modal-write-comment-container">
                                <input type="hidden" id="post-id" name="post_id" value="<?= $post['id'] ?>">
                                <textarea class="modal-input-post input-post" id="comment-content" name="comment_content"
                                          placeholder="Write a comment..." minlength="1" maxlength="120" required></textarea>
                                <button type="submit" class="modal-post-button" name="submit-comment" value="create_comment">
                                    Poster
                                </button>
                            </div>
                        </form>
                        <div class="modal-comments">
                            <?php foreach ($post_comments as $comment) {
                                $comment_user = (new GetUser())->execute($comment['user_id']); ?>
                                <div class="modal-comment">
                                    <img class="modal-comment-avatar" src="client/templates/img/<?= $comment_user->avatar ?>.png"
                                         alt="comment avatar">
                                    <div class="modal-comment-content">
                                        <div class="modal-comment-information">
                                            <p class="modal-comment-name"><?= $comment_user->name ?></p>
                                            <p class="modal-comment-date"><?= $comment['creation_date'] ?></p>
                                        </div>
                                        <div class="modal-comment-text"><?= $comment['message'] ?></div>
                                    </div>
                                    <form class="modal-comment-votes" action="/comment_votes" method="POST">
                                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                                        <button type="submit" class="comment-up-button form-btn-votes" name="vote" value="1"><i
                                                    class="fa-solid fa-chevron-up"></i></button>
                                        <span class="comment-votes">
                                            <?php
                                            $votesCount = new VotesRepository();
                                            $upVotesCount = $votesCount->countVote(1, $comment['id']);
                                            $downVotesCount = $votesCount->countVote(2, $comment['id']);
                                            echo $upVotesCount - $downVotesCount;
                                            ?>
                                        </span>
                                        <button type="submit" class="comment-down-button form-btn-votes" name="vote" value="2"><i
                                                    class="fa-solid fa-chevron-down"></i></button>
                                    </form>
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
