<div class="post-panel">
    <F1>Accueil</F1>
    <div class="write-post">
        <form action="/create_post" method="POST">
        <div class="header-post">
            <div class="avatar-box">
                <?php global $avatar; ?>
                <?php $avatar = "client/templates/img/catspaghetti.png"; ?>
                <img alt="profile-picture" class="avatar" src="<?= $avatar ?>">
            </div>
            <div class="input">
                <label>
                    <input type="text" class="input-post" name="message" placeholder="Ecris quelque chose...">
                </label>
            </div>
            <label for="pet-select">Choose a pet:</label>

            <select name="emotions" id="emotions-select">
                <option value="1">heureux</option>
                <option value="2">déçu</option>
                <option value="3">douteux</option>
                <option value="4">triste</option>
            </select>
        </div>
        <div class="footer-post">
            <div class="img-box">
                <img alt="profile-picture" class="insert-img" src="client/templates/img/img.png">
            </div>
            <div class="post-button-box">
                <button type="submit" class="post-button" value="create_post">Publier</button>
            </div>
        </form>
        </div>
    </div>
</div>