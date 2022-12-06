<?php $title = 'Profil';
$styles = ['profil.css', 'menu.css', 'main.css', 'post.css', "friends_panel.css", "right-panel.css", "profile.css"];

global $connected_user;
?>

<?php ob_start(); ?>

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
        <div class="profil-picture">
            <img src="client/templates/img/<?= $connected_user->avatar ?>.png" alt="picture profil">
            <p><?= $connected_user->name ?></p>
            <p class="bio"><?= $connected_user->description ?></p>
        </div>

        <div class="">
            <a href="/settings-page">Paramètres</a>
        </div>
        <div class="friends">
            <p>Amis</p>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require_once 'base.php'; ?>