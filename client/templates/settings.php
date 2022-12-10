<?php $title = 'Paramètres';
$styles = ['settings.css', 'menu.css', 'main.css'];

require_once('client/templates/components/menu.php');

global $connected_user;

ob_start(); ?>

<div class="settings-page">
    <span class="page-title">Paramètres</span>

    <form action="/settings" enctype="multipart/form-data" id="settings-form" method="POST">

        <div class="name-settings settings-category">
            <span class="settings-type">Nom d'utilisateur<i class="fa-solid fa-arrow-right"></i></span>
            <input class="form-control" id="name" name="name" type="text"
                   value="<?php echo $connected_user->name ?? null; ?>" autocomplete="off" maxlength="20">
        </div>

        <div class="mail-settings settings-category">
            <span class="settings-type">Mail<i class="fa-solid fa-arrow-right"></i></span>
            <input class="form-control" id="mail" name="mail" type="text"
                   value="<?php echo $connected_user->mail ?? null; ?>" autocomplete="off" maxlength="255">
        </div>

        <div class="password-settings settings-category">
            <span class="settings-type">Mot de passe<i class="fa-solid fa-arrow-right"></i></span>
            <input class="form-control" id="password" name="password" type="password"
                   placeholder="Mettre encrypt password du connected user" autocomplete="off" maxlength="50">
        </div>

        <div class="avatar-settings settings-category">
            <span class="settings-type">Avatar<i class="fa-solid fa-arrow-right"></i></span>
            <div class="avatar-box">
                <img class="avatar-choices" src="client/templates/img/catspaghetti.png" alt="avatar">
                <input class="form-control form-control-avatar" id="catspaghetti" name="avatar" value="catspaghetti" type="radio" <?php if ($connected_user->avatar === 'catspaghetti') echo "checked"?>>
            </div>
            <div class="avatar-box">
                <img class="avatar-choices" src="client/templates/img/catdepressed.png" alt="avatar">
                <input class="form-control form-control-avatar" id="catdepressed" name="avatar" value="catdepressed" type="radio" <?php if ($connected_user->avatar === 'catdepressed') echo "checked"?>>
            </div>
            <div class="avatar-box">
                <img class="avatar-choices" src="client/templates/img/cathaha.png" alt="avatar">
                <input class="form-control form-control-avatar" id="cathaha" name="avatar" value="cathaha" type="radio" <?php if ($connected_user->avatar === 'cathaha') echo "checked"?>>
            </div>
            <div class="avatar-box">
                <img class="avatar-choices" src="client/templates/img/cathefuck.png" alt="avatar">
                <input class="form-control form-control-avatar" id="cathefuck" name="avatar" value="cathefuck" type="radio" <?php if ($connected_user->avatar === 'cathefuck') echo "checked"?>>
            </div>
            <div class="avatar-box">
                <img class="avatar-choices" src="client/templates/img/catstare.png" alt="avatar">
                <input class="form-control form-control-avatar" id="catstare" name="avatar" value="catstare" type="radio" <?php if ($connected_user->avatar === 'catstare') echo "checked"?>>
            </div>
        </div>

        <div class="bio-settings settings-category">
            <span class="settings-type">Biographie<i class="fa-solid fa-arrow-right"></i></span>
            <input class="form-control" id="bio" name="bio" type="text"
                   value="<?php echo $connected_user->description ?? null; ?>" autocomplete="off" maxlength="150">
        </div>

        <div class="confirm-password-settings settings-category">
            <input class="form-control" id="confirm-password" name="confirm-password" type="password"
                   placeholder="Confirmer mot de passe" autocomplete="off" required>
            <button class="custom-btn settings-button btn-8" type="submit" name="submit-settings" value="settings">VALIDER</button>
        </div>

    </form>
</div>

<?php $content = ob_get_clean();
require_once 'base.php'; ?>