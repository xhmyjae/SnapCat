<?php $styles = ['error.css'];

global $error;

ob_start(); ?>
<script defer src="client/scripts/error-popup.js"></script>

<div class="popup">
    <h2>Error</h2>
    <div class="content">
        <?php if ($error) echo '<p>error</p>'?>
    </div>
</div>

<?php $error_popup = ob_get_clean(); ?>