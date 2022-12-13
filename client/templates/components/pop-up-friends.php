<?php
global $user_friends;
global $connected_user;
global $user;
?>

<dialog class="modal-friends-dialog">
    <div class="modal-friends">
        <div class="modal-friends-header">
            <h2 class="modal-friends-title">Friends</h2>
            <i class="fa-solid fa-xmark close-modal-friends"></i>
        </div>
        <div class="modal-friends-list">
            <?php foreach ($user_friends as $friend) { ?>
                <div class="modal-friend">
                    <img class="modal-friend-avatar" src="client/templates/img/<?= $friend->avatar ?>.png" alt="friend avatar">
                    <p class="modal-friend-name"><?= $friend->name ?></p>
                    <?php if ($user->id === $connected_user->id) { ?>
                        <a class="profile-links red popup-friends-delete" href="/deletefriend?user_id=<?= $friend->id ?>">Supprimer</a>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
</dialog>
