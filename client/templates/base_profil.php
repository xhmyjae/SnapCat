<?php

global $is_friend;
$title = 'Profile';
$styles = ['profil.css', 'menu.css', 'main.css', 'pop-up_post.css'];

require_once('client/templates/components/menu.php');

global $user;
global $connected_user;
global $posts;
global $has_requested;
global $post;

ob_start(); ?>

    <script defer src="client/scripts/popup-post.js"></script>

    <div class="profil-panel">
        <div class="top-profil">
            <?php global $banner; ?>
            <?php $banner = "client/templates/img/banner.jpg"; ?>
            <div class="banner">
                <img src="<?= $banner ?>" alt="banner profil">
            </div>
            <div class="profile-information">
                <div class="profile-information-left">
                    <img class="profil-picture" src="client/templates/img/<?= $user->avatar ?>.png"
                         alt="picture profil">
                    <?php if ($is_friend == 1) { ?>
                        <a class="profile-links red" href="/deletefriend?user_id=<?= $user->id ?>">Supprimer</a>
                    <?php } else { ?>
                        <?php if ($has_requested == 1 || $user->id == $connected_user->id) { ?>
                            <a class="profile-links" href="">En attente</a>
                        <?php } else { ?>
                            <a class="profile-links" href="/addfriend?user_id=<?= $user->id ?>">Ajouter</a>
                        <?php }
                    } ?>


                    <p class="friends-popup-link">Amis</p>
                </div>
                <div class="profile-information-right">
                    <div class="name-box">
                        <p class="user-name"><?= $user->name ?></p>
                        <?php if ($connected_user->id === $user->id) echo '<a class="profile-links" href="settings-page">Modifier profil</a>' ?>
                    </div>
                    <span class="description-box"><?= $user->description ?></span>
                </div>
            </div>
        </div>
        <div class="users-profile-posts">
            <div class="user-posts">
                <?php require_once('client/templates/components/pop-up-post.php'); ?>
            </div>
        </div>

    </div>

<?php $content = ob_get_clean(); ?>


<?php require_once 'base.php'; ?>