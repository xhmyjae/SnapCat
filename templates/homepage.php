<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta content="IE=edge" http-equiv="X-UA-Compatible">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Dxvy, Ker, Thomas, xhmyjae" name="author">
  <meta content="Page principale de Snapagram" name="description">
  <title>Accueil | Snapagram</title>
</head>
<body>
    <p class="error"><?php global $error;
        echo $error; ?></p>
    <div class="list">
        <?php
        global $posts;
        if (empty($posts)) {
            echo '<p class="empty">No tasks to show</p>';
        }
        foreach ($posts as $post) {
            ?>
        <div class="list-element">
            <p class="task-priority"><?= $post->id ?></p>
            <p class="task-name"><?= $post->message ?></p>
        </div>
        <?php
        }
        ?>
</body>
</html>