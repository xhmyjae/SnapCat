<link rel="stylesheet" type="text/css" href="../style/settings.css"/>
<link rel="stylesheet" type="text/css" href="../style/main.css"/>
<script src="https://kit.fontawesome.com/74fed0e2b5.js" crossorigin="anonymous"></script>

<div class="settings">
    <span class="settings-title">Paramètres</span>

    <form action="/settings" enctype="multipart/form-data" id="settings-form" method="POST">

        <div class="name-settings settings-category">
            <span class="settings-type">Nom d'utilisateur<i class="fa-solid fa-arrow-right"></i></span>
            <input class="form-control" id="username" name="username" type="text"
                   placeholder="Mettre nom du connected user" autocomplete="off" maxlength="20">
<!--            if focus => value = nom-->
        </div>

        <div class="mail-settings settings-category">
            <span class="settings-type">Mail<i class="fa-solid fa-arrow-right"></i></span>
            <input class="form-control" id="mail" name="mail" type="text"
                   placeholder="Mettre mail du connected user" autocomplete="off" maxlength="255">
        </div>

        <div class="password-settings settings-category">
            <span class="settings-type">Mot de passe<i class="fa-solid fa-arrow-right"></i></span>
            <input class="form-control" id="password" name="password" type="password"
                   placeholder="Mettre encrypt password du connected user" autocomplete="off" maxlength="50">
        </div>

        <div class="avatar-settings settings-category">
            <span class="settings-type">Avatar<i class="fa-solid fa-arrow-right"></i></span>
            <div class="avatar-box">
                <img class="avatar-choices" src="Img/catspaghetti.png" alt="avatar">
                <input class="form-control form-control-avatar" id="avatar1" name="avatar1" type="radio">
            </div>
            <div class="avatar-box">
                <img class="avatar-choices" src="Img/catdepressed.png" alt="avatar">
                <input class="form-control form-control-avatar" id="avatar1" name="avatar1" type="radio">
            </div>
            <div class="avatar-box">
                <img class="avatar-choices" src="Img/cathaha.png" alt="avatar">
                <input class="form-control form-control-avatar" id="avatar1" name="avatar1" type="radio">
            </div>
            <div class="avatar-box">
                <img class="avatar-choices" src="Img/cathefuck.png" alt="avatar">
                <input class="form-control form-control-avatar" id="avatar1" name="avatar1" type="radio">
            </div>
            <div class="avatar-box">
                <img class="avatar-choices" src="Img/catstare.png" alt="avatar">
                <input class="form-control form-control-avatar" id="avatar1" name="avatar1" type="radio">
            </div>
        </div>

        <div class="bio-settings settings-category">
            <span class="settings-type">Biographie<i class="fa-solid fa-arrow-right"></i></span>
            <input class="form-control" id="bio" name="bio" type="text"
                   placeholder="Mettre bio du connected user" autocomplete="off" maxlength="150">
        </div>

        <div class="confirm-password-settings settings-category">
            <input class="form-control" id="confirm-password" name="confirm-password" type="password"
                   placeholder="Confirmer mot de passe" autocomplete="off" required>
            <button class="custom-btn settings-button btn-8" type="submit" name="submit-settings" value="login">VALIDER</button>
        </div>

    </form>
</div>



<!--        </div>-->
<!--        <div class="picture-setting">-->
<!--            <img src="../img/Ezio.jpg" alt="picture profil">-->
<!--            <button class="custom-btn setting-button">Changer Photo</button>-->
<!--        </div>-->
<!--        <div class="bio-setting">-->
<!--            <p>sfddsf sfddsf sfddsf sfddsf sfddsf sfddsf sfddsf sfddsf sfddsf sfddsf sfddsf </p>-->
<!--            <button class="custom-btn setting-button">Changer Bio</button>-->
<!--        </div>-->
<!--        <div class="password-setting">-->
<!--            <form>-->
<!--                <div class="group">-->
<!--                    <input type="text" required>-->
<!--                    <span class="highlight"></span>-->
<!--                    <span class="bar"></span>-->
<!--                    <label>Mot de passe</label>-->
<!--                </div>-->
<!--            </form>-->
    <!--        <input type="password" name="password" placeholder="Mot de passe">-->
<!--            <button class="custom-btn setting-button"">Modifier Mot de passe</button>-->
<!--            <button class="custom-btn setting-button"">Confirmer</button>-->
<!--        </div>-->

<?php
