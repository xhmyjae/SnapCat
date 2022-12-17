<?php
global $friends_posts;
global $connected_user;
global $reactionsCount;
global $length;

$offset = 0;
$length = 5;

use App\Controllers\User\GetUser\GetUser;
use App\Model\Comments\CommentRepository;
use App\Model\Reactions\ReactionsRepository;
use App\Model\Votes\VotesRepository;

require_once 'src/controllers/getFriendsPost.php';
require_once 'src/controllers/GetUser.php';
require_once 'src/model/comments.php';
require_once 'src/model/reactions.php';
require_once 'src/controllers/count_reactions.php';
require_once 'src/controllers/count_votes.php';

$reactionsCount = new ReactionsRepository();
$commentCount = new CommentRepository();
$votesCount = new VotesRepository();

foreach (array_slice($friends_posts, $offset, $length) as $post) {
    $user_method = new GetUser();
    $user = $user_method->execute($post['user_id']);
    $post_comments = (new CommentRepository())->getComments($post['id']);
    // sort comments by votes
//    usort($post_comments, function ($a, $b) {
//        global $votesCount;
//        $upVotesCountA = $votesCount->countVote(1, $a['id']);
//        $downVotesCountA = $votesCount->countVote(2, $a['id']);
//        $resultA = $upVotesCountA - $downVotesCountA;
//        $upVotesCountB = $votesCount->countVote(1, $b['id']);
//        $downVotesCountB = $votesCount->countVote(2, $b['id']);
//        $resultB = $upVotesCountB - $downVotesCountB;
//        return $resultB <=> $resultA;
//    });
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
                                <button type="submit" class="delete-button form-btn" value="delete_post"><i
                                            class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </div>
                    <?php } ?>
                </div>
                <p class="post-message"><?= $post['message'] ?></p>
                <?php if ($post['picture'] != null) { ?>
                    <img class="post-picture" src="<?= $post['picture'] ?>" alt="post-picture">
                <?php } ?>
                <div class="post-footer">
                    <div class="post-reactions">
                        <form class="react-button" action="/add_reactions" method="POST">
                            <input type="hidden" name="post_id" value="<?= $post['id']; ?>">
                            <button type="submit" class="like-button form-btn" name="emoji" value="1">👍<span class="count <?php if ($reactionsCount->hasReactedWithEmoji(1, $post['id'], $connected_user->id)) echo 'reacted' ?>">
                                    <?php
                                    echo $reactionsCount->countReaction(1, $post['id']);
                                    ?>
                                </span></button>
                            <button type="submit" class="dislike-button form-btn" name="emoji" value="2">👎<span class="count <?php if ($reactionsCount->hasReactedWithEmoji(2, $post['id'], $connected_user->id)) echo 'reacted' ?>">
                                    <?php
                                    echo $reactionsCount->countReaction(2, $post['id']);
                                    ?>
                                </span>
                            </button>
                            <button type="submit" class="love-button form-btn" name="emoji" value="3">❤️<span class="count <?php if ($reactionsCount->hasReactedWithEmoji(3, $post['id'], $connected_user->id)) echo 'reacted' ?>">
                                    <?php
                                    echo $reactionsCount->countReaction(3, $post['id']);
                                    ?>
                                </span>
                            </button>
                            <button type="submit" class="sad-button form-btn" name="emoji" value="4">😭<span class="count <?php if ($reactionsCount->hasReactedWithEmoji(4, $post['id'], $connected_user->id)) echo 'reacted' ?>">
                                    <?php
                                    echo $reactionsCount->countReaction(4, $post['id']);
                                    ?>
                                </span>
                            </button>
                            <button type="submit" class="sad-button form-btn" name="emoji" value="5">😡<span class="count <?php if ($reactionsCount->hasReactedWithEmoji(5, $post['id'], $connected_user->id)) echo 'reacted' ?>">
                                    <?php
                                    echo $reactionsCount->countReaction(5, $post['id']);
                                    ?>
                                </span>
                            </button>
                        </form>
                    </div>
                    <button class="comment-button <?= $post['id']; ?>"><i class="fa-regular fa-comment"></i></button>
                    <span id="commentCount" class="count">
                        <?php
                        echo $commentCount->countComments($post['id']);
                        ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="comments <?= $post['id']; ?> hidden">
            <form class="write-comment-form" action="/create_comment" method="POST">
                <img alt="profile-picture" class="avatar" src="client/templates/img/<?= $connected_user->avatar ?>.png">
                <div class="write-comment-container">
                    <input type="hidden" id="post-id" name="post_id" value="<?= $post['id'] ?>">
                    <textarea class="input-post" id="comment-content" name="comment_content"
                              placeholder="Write a comment..." minlength="1" maxlength="120" required></textarea>
                    <button type="submit" class="post-button" name="submit-comment" value="create_comment">
                        Poster
                    </button>
                </div>
            </form>
            <?php foreach ($post_comments as $comment) {
                $comment_user = $user_method->execute($comment['user_id']);?>
                <div class="comment">
                    <img alt="profile-picture" class="avatar"
                         src="client/templates/img/<?= $comment_user->avatar ?>.png">
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
                                <button type="submit" class="delete-button form-btn" value="delete_comment"><i
                                            class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </div>
                    <?php } ?>
                    <form class="comment-votes-form" action="/comment_votes" method="POST">
                        <input type="hidden" name="comment_id" value="<?= $comment['id'] ?>">
                        <button type="submit" class="comment-up-button form-btn" name="vote" value="1"><i
                                    class="fa-solid fa-chevron-up <?php if ($votesCount->hasVoteWithVote(1, $comment['id'], $connected_user->id)) echo 'reacted' ?>"></i></button>
                        <span class="comment-votes">
                            <?php
                            $upVotesCount = $votesCount->countVote(1, $comment['id']);
                            $downVotesCount = $votesCount->countVote(2, $comment['id']);
                            echo $upVotesCount - $downVotesCount;
                            ?>
                        </span>
                        <button type="submit" class="comment-down-button form-btn" name="vote" value="2"><i
                                    class="fa-solid fa-chevron-down <?php if ($votesCount->hasVoteWithVote(2, $comment['id'], $connected_user->id)) echo 'reacted' ?>"></i></button>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>