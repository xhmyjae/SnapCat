<?php $title = 'Profil';
$styles = ['profil.css', 'menu.css', 'main.css', 'post.css', "friends_panel.css", "right-panel.css", "profile.css"];
?>

<?php ob_start(); ?>

<link rel="stylesheet" type="text/css" href="../style/main.css"/>
<link rel="stylesheet" type="text/css" href="../style/profil.css"/>
<link rel="stylesheet" type="text/css" href="../style/menu.css"/>
<script src="https://kit.fontawesome.com/74fed0e2b5.js" crossorigin="anonymous"></script>

<div class="profil-panel">
    <div class="top-profil">
        <?php global $banner; ?>
        <?php $banner = "client/templates/img/GodOfWar3_Hero.png"; ?>
        <div class="banner">
            <img src="<?= $banner ?>" alt="banner profil">
        </div>
        <?php global $avatar; ?>
        <?php $pp = "client/templates/img/catspahetti.png"; ?>
        <div class="profil-picture">
            <img src="img/Ezio.jpg" alt="picture profil">
            <p>Ezio Auditore</p>
            <p class="bio"></p>
        </div>
        <div class="friends">
            <p>Amis</p>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require_once 'base.php'; ?>