<?php $title = 'Snapagram';
$styles = ['login.css'];
?>

<?php ob_start(); ?>

    <div class="main">
        <!--        register-->
        <form class="form" id="a-form" method="POST" action="/index.php?signup">
            <h2 class="form_title title">S'inscrire</h2>
            <input class="form__input" type="text" placeholder="Pseudo" autofocus name="name" required maxlength="20" minlength="3">
            <input class="form__input" type="email" placeholder="Email" name="mail" required maxlength="255">
            <input class="form__input" type="password" placeholder="Mot de passe" name="password" required maxlength="50">
            <input class="form__input" type="password" placeholder="Confirmer mot de passe" required>
            <button class="form__button button submit" type="submit" name="submit-signup" value="signup">S'inscrire</button>
        </form>

    </div>
    <div class="container b-container" id="b-container">

        <!--        login-->
        <form class="form" id="b-form" method="POST" action="/index.php?login">
            <h2 class="form_title title">Se connecter</h2>
            <input class="form__input" type="text" placeholder="Email ou pseudo" autofocus name="ids" required maxlength="255">
            <input class="form__input" type="password" placeholder="Mot de passe" name="password" required maxlength="50">
            <button class="form__button button submit" type="submit" name="submit-login" value="login">SIGN IN</button>
        </form>

    </div>
        <div class="switch" id="switch-cnt">
            <div class="switch__circle"></div>
            <div class="switch__circle switch__circle--t"></div>
            <div class="switch__container" id="switch-c1">
                <h2 class="switch__title title">Re.</h2>
                <p class="switch__description description"> Pour rester avec nous, veuillez vous connecter avec votre
                    compte personnel</p>
                <button class="switch__button button switch-btn">Se connecter</button>
            </div>
            <div class="switch__container is-hidden" id="switch-c2">
                <h2 class="switch__title title">Hola !</h2>
                <p class="switch__description description">Entrez vos données personnelles et commencez votre voyage
                    avec nous</p>
                <button class="switch__button button switch-btn">S'inscrire</button>
            </div>
        </div>
    </div>
    <script defer src="client/scripts/login.js"></script>

<?php $content = ob_get_clean(); ?>

<?php require_once 'base.php'; ?>
>>>>>>> 34f62b128c148fc14a87badb814dc9da1e3c99fc
