<?php

global $is_friend;
$title = 'Profile';
$styles = ['profil.css', 'menu.css', 'main.css'];

require_once('client/templates/components/menu.php');

global $user;
global $connected_user;
global $posts;

echo $is_friend;
ob_start(); ?>

<link rel="stylesheet" type="text/css" href="../style/main.css"/>
<link rel="stylesheet" type="text/css" href="../style/profil.css"/>
<link rel="stylesheet" type="text/css" href="../style/menu.css"/>
<script src="https://kit.fontawesome.com/74fed0e2b5.js" crossorigin="anonymous"></script>


<div class="profil-panel">
    <div class="top-profil">
        <?php global $banner; ?>
        <?php $banner = "client/templates/img/banner.jpg"; ?>
        <div class="banner">
            <img src="<?= $banner ?>" alt="banner profil">
        </div>
        <div class="profile-information">
            <div class="profile-information-left">
                <img class="profil-picture" src="client/templates/img/<?= $user->avatar ?>.png" alt="picture profil">
                <?php if ($is_friend==1) echo '<a class="profile-links" href="/deletefriend?user_id2=<?=$friend_request->id?>">Supprimer</a>';
                else echo '<a class="profile-links" href="/addfriend?user_id2=<?=$friend_request->id?>">Ajouter</a>' ?>

                <p class="friends-popup-link">Amis</p>
            </div>
            <div class="profile-information-right">
                <div class="name-box">
                    <p class="user-name"><?= $user->name ?></p>
                    <?php if ($connected_user->id === $user->id) echo '<a class="profile-links" href="settings-page">Modifier profil</a>'?>
                </div>
                <span class="description-box"><?= $user->description ?></span>
            </div>
        </div>
    </div>
    <div class="user-posts">
        <?php
        if ($posts !== null) {
            foreach ($posts as $post) {?>
                <div class="post-profile">
                    <div class="post-profile-container">
                        <p class="post-profile-text"><?= $post['message'] ?></p>
                    </div>
                    <a href="" class="delete-post-profile"><i class="fa-solid fa-trash-can"></i></a>
                </div>
            <?php } ?>
        <?php } else {
            echo "Cet utilisateur n'a jamais rien envoyé ici...";
        } ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>


<?php require_once 'base.php'; ?>