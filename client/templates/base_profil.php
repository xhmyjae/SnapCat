<?php $title = 'Profile';
$styles = ['profil.css', 'menu.css', 'main.css'];

require_once('client/templates/components/menu.php');

//$avatar = new GetAvatar();
//$avatar->execute($_SESSION['id']);

global $user;
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
        <div class="profile-information">
            <div class="profile-information-left">
                <img class="profil-picture" src="client/templates/img/<?= $user->avatar ?>.png" alt="picture profil">
                <a class="profile-links" href="">Ajouter</a>
               <a class="profile-links" href="">Supprimer</a>
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

    </div>
</div>

<?php $content = ob_get_clean(); ?>


<?php require_once 'base.php'; ?>