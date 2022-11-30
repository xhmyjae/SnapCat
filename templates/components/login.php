<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../../style/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <title>Snapagram</title>
</head>
<body>
<div class="main">
    <div class="container a-container" id="a-container">
        <form class="form" id="a-form" method="POST" action="">
            <h2 class="form_title title">S'inscrire</h2>
            <input class="form__input" type="text" placeholder="Pseudo">
            <input class="form__input" type="text" placeholder="Email">
            <input class="form__input" type="password" placeholder="Nouveau mot de passe">
            <input class="form__input" type="password" placeholder="Confirmer nouveau mot de passe">
            <button class="form__button button submit">S'inscrire</button>
        </form>
    </div>
    <div class="container b-container" id="b-container">
        <form class="form" id="b-form" method="" action="">
            <h2 class="form_title title">Se connecter</h2>
            <input class="form__input" type="text" placeholder="Adresse e-mail">
            <input class="form__input" type="password" placeholder="Mot de passe"><a class="form__link">Mot de passe oublié ?</a>
            <button class="form__button button submit">SIGN IN</button>
        </form>
    </div>
    <div class="switch" id="switch-cnt">
        <div class="switch__circle"></div>
        <div class="switch__circle switch__circle--t"></div>
        <div class="switch__container" id="switch-c1">
            <h2 class="switch__title title">Re.</h2>
            <p class="switch__description description"> Pour rester avec nous, veuillez vous connecter avec votre compte personnel</p>
            <button class="switch__button button switch-btn">SIGN IN</button>
        </div>
        <div class="switch__container is-hidden" id="switch-c2">
            <h2 class="switch__title title">Hola !</h2>
            <p class="switch__description description">Entrez vos données personnelles et commencez votre voyage avec nous</p>
            <button class="switch__button button switch-btn">SIGN UP</button>
        </div>
    </div>
</div>
<script defer src="../../Javascript/login.js"></script>
</body>
</html>
