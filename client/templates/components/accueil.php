<?php
global $connected_user;
?>

<script defer src="client/scripts/write-post.js"></script>

<div class="post-panel">
    <p class="page-title">Accueil</p>
    <div class="write-post">
        <form class="write-post-form" action="/create_post" method="POST">
            <img alt="profile-picture" class="avatar" src="client/templates/img/<?= $connected_user->avatar ?>.png">
            <div class="write-post-box">
                <select name="emotion" id="emotions-select" required>
                    <option value="1">Hihi 😄</option>
                    <option value="2">Ehw 😔</option>
                    <option value="3">Humm 🤔</option>
                    <option value="4">Sadge 😭</option>
                </select>
<!--                <input type="text" contenteditable="true" class="input-post" name="message" placeholder="Ecris quelque chose..." minlength="2" maxlength="400" required>-->
<!--                <span contenteditable="true" class="input-post" name="message" placeholder="Ecris quelque chose..." minlength="2" maxlength="400" required></span>-->
                <textarea contenteditable="true" class="input-post" name="message" placeholder="Ecris quelque chose..." minlength="2" maxlength="400" required></textarea>
                <div class="write-post-footer">
                    <i class="fa-solid fa-image"></i>
                    <button type="submit" class="post-button" value="create_post">Publier</button>
                </div>
            </div>
        </form>
    </div>
    <div class="posts">
        <?php require_once('client/templates/components/Friendspost.php'); ?>
    </div>
</div>