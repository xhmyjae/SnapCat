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
            <div class="feelings">
                <label for="pet-select">Feeling : </label>

                <select name="emotions" id="emotions-select">
                    <option value="1">Heureux 😄</option>
                    <option value="2">Déçu 😔</option>
                    <option value="3">Douteux 🤔</option>
                    <option value="4">Triste 😭</option>
                </select>
            </div>

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