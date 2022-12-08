<?php
global $posts;
?>



<?php
foreach ($posts as $post): ?>

    <div class="post-panel">
            <div class="post">
                <div class="container">
                    <div class="header-post">
                        <div class="avatar-box">
                            <img alt="profile-picture" class="avatar" src="client/templates/img/beemo.png">
                        </div>
                    </div>
                    <div class="content-post">
                        <p class="pseudo"></p>
                        <p class="content"><?php  echo $post['message']; ?></p>
                        </p>
                    </div>
                </div>
                <div class="react">
                    <span>👍<p>199</p> </span>
                    <span>👎<p>199</p></span>
                    <span>❤<p>199</p></span>
                    <span>😄<p>199</p></span>
                    <span>😭<p>199</p></span>
                    <span>💬<p>199</p></span>
                </div>
            </div>
    </div>
<?php endforeach; ?>
