<?php $title = 'Profile';
$styles = ['profil.css', 'menu.css', 'main.css'];

require_once('client/templates/components/menu.php');

//$avatar = new GetAvatar();
//$avatar->execute($_SESSION['id']);

global $connected_user;

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
        <div class="profil-picture">
            <img src="client/templates/img/<?= $connected_user->avatar ?>.png" alt="picture profil">
            <div class="user-infos">
                <p class="user-name"><?= $connected_user->name ?></p>
                <p class="user-bio"><?= $connected_user->description ?></p>
            </div>
        </div>

        <div>
            <a class="settings-button" href="/settings-page">Paramètres</a>
        </div>
        <div class="friends">
            <p>Amis</p>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require_once 'base.php'; ?>