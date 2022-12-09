<?php
    global $friends;
    global $friend_requests;
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
            <?php foreach ($friend_requests as $friend_request): ?>
                <a href="/profile?user_id=<?=$friend_request->id ?>" class="friend">
                    <div class="friend-avatar">
                        <img src="client/templates/img/<?= $friend_request->avatar ?>.png" alt="friend picture">
                    </div>
                    <div class="friend-name">
                        <p><?= $friend_request->name ?></p>
                    </div>
                    <div class="Accept_button">
                        <a href="/addfriend?user_id2=<?=$friend_request->id?>">
                            <i class="fas fa-check"></i>
                        </a>
                        <a href="/deletefriend?user_id2=<?=$friend_request->id?>">
                            <i class="fas fa-xmark"></i>
                        </a>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <div class="waiting-container">

        </div>
    </div>
</div>


