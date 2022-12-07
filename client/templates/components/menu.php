<?php global $connected_user;?>

<script src="https://kit.fontawesome.com/74fed0e2b5.js" crossorigin="anonymous"></script>
<script defer src="client/scripts/logout.js"></script>
<!--<script defer src="client/scripts/redirect.js"></script>-->
<script defer src="client/scripts/friends-panel.js"></script>


<div class="menu">
    <div class="site-title-box">
        <p id="site-title">SNAPCAT</p>
    </div>
    <div class="categories">
        <ul>
            <li class="category"><a href="/homepage"><span class="list-icon"><i class="fa-regular fa-comment"></i></span>Accueil</a></li>
            <li class="category"><span class="list-icon"><i class="fa-regular fa-bell"></i></span>Notifications</li>
            <li class="category"><span class="list-icon"><i class="fa-solid fa-wand-magic-sparkles"></i></span>Découvrir</li>
            <li class="category"><a href="/profile?user_id=<?= $connected_user->id ?? null ?>"><span class="list-icon"><i class="fa-regular fa-user"></i></span>Profil</a></li>
            <li class="category"><a href="/logout"><span class="list-icon"><i class="fa-solid fa-door-open"></i></span>Se déconnecter</a></li>
        </ul>
    </div>
    <div class="search-box">
        <label>
            <input type="text" class="search-input" placeholder="Recherche...">
        </label>
        <button class="search-button"><i class="fas fa-search"></i></button>
    </div>
</div>