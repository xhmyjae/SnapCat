<?php $title = 'SnapCat';
$styles = ['menu.css', 'main.css', 'post.css', "friends_panel.css", "right-panel.css", "profile.css, comments.css"];

?>

<?php ob_start(); ?>

<?php require_once('client/templates/components/menu.php'); ?>
<?php require_once('client/templates/components/accueil.php'); ?>
<?php require_once('client/templates/components/friends_panel.php'); ?>


<?php $content = ob_get_clean(); ?>

<?php require_once 'base.php'; ?>
