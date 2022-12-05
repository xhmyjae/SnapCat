<?php $title = 'SnapCat';
$styles = ['menu.css', 'main.css', 'post.css', "friends_panel.css", "right-panel.css", "profile.css"];
?>

<?php ob_start(); ?>


<?php require_once('client/templates/components/accueil.php'); ?>



<?php $content = ob_get_clean(); ?>

<?php require_once 'base.php'; ?>
