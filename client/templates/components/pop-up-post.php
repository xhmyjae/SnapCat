<?php global $post ?>
<script src="https://kit.fontawesome.com/74fed0e2b5.js" crossorigin="anonymous"></script>
<script defer src="client/scripts/popup-post.js"></script>

<div class="modal-post">
<!--    <span class="close">&times;</span>-->
    <div class="modal-post-content">
        <p class="modal-post-date"><?= $post['creation_date'] ?></p>
        <p class="modal-post-content-text"><?= $post['message'] ?></p>
    </div>
    <div class="modal-information">
        <div class="modal-reactions">
            <div class="modal-reaction">
                <a href="" class="modal-reaction-icon"><i class="fa-solid fa-thumbs-up"></i><p class="modal-reaction-number">222</p></a>
            </div>
            <div class="modal-reaction">
                <a href="" class="modal-reaction-icon"><i class="fa-solid fa-thumbs-down"></i><p class="modal-reaction-number">222</p></a>
            </div>
            <div class="modal-reaction">
                <a href="" class="modal-reaction-icon"><i class="fa-solid fa-heart"></i><p class="modal-reaction-number">222</p></a>
            </div>
            <div class="modal-reaction">
                <a href="" class="modal-reaction-icon"><i class="fa-solid fa-star"></i><p class="modal-reaction-number">222</p></a>
            </div>
            <div class="modal-reaction">
                <a href="" class="modal-reaction-icon"><i class="fa-solid fa-star"></i><p class="modal-reaction-number">222</p></a>
            </div>
        </div>
        <div class="modal-comments">
            <div class="modal-comment">
                <img class="modal-comment-avatar" src="../img/catspaghetti.png" alt="comment avatar">
                <div class="modal-comment-content">
                    <div class="modal-comment-information">
                        <p class="modal-comment-name">jae</p>
                        <p class="modal-comment-date">22-01-01</p>
                    </div>
                    <div class="modal-comment-text">wjbvwlijfbwk.jfbwijfbwj kjnfjk; njn ijwnfjk njn f kjw nfkwjnfnf kn ngbjkelbv wjbf jwebfijbefjgf bjm</div>
                </div>
                <div class="modal-comment-votes">
                    <i class="fa-solid fa-chevron-up"></i>
                    <p class="modal-comment-votes-total">23</p>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
