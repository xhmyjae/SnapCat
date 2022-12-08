<?php
global $friends;
?>

<script src="https://kit.fontawesome.com/74fed0e2b5.js" crossorigin="anonymous"></script>
<script defer src="client/scripts/friends-panel.js"></script>


<div class="right-panel">
    <div class="Switch">
        <div  class="Switch_button" id="friends" data-switch="friends">Amis</div>
        <div class="Switch_button" id="request" data-switch="comments">Requetes</div>
        <div class="Switch_button" id="waiting" data-switch="messages">Demandes</div>
    </div>
    <div class="Friend-list">

        <div class="friends-container">
            <?php foreach ($friends as $friend): ?>
                <a href="/profile?user_id=<?=$friend->id ?>" class="friend">
                    <div class="friend-avatar">
                        <img src="client/templates/img/<?= $friend->avatar ?>.png" alt="friend picture">
                    </div>
                    <div class="friend-name">
                        <p><?= $friend->name ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="request-container">
            <div class="friend" data-friend="1">
                <div class="friend_avatar">
                    <img src="client/templates/img/antaBinome.png" alt="avatar">
                </div>
                <div class="Friend_name">
                    <p>Best binome 2</p>
                </div>
                <div class="Accept_button">
                    <i class="fas fa-check"></i>
                    <i class="fas fa-xmark"></i>
                </div>
            </div>
            <div class="friend" data-friend="1">
                <div class="friend_avatar">
                    <img src="client/templates/img/antaBinome.png" alt="avatar">
                </div>
                <div class="Friend_name">
                    <p>Best binome 3</p>
                </div>
                <div class="Accept_button">
                    <i class="fas fa-check"></i>
                    <i class="fas fa-xmark"></i>
                </div>
            </div>
        </div>
        <div class="waiting-container">

        </div>
    </div>
</div>


