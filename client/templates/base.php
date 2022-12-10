<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?= $title ?? "" ?></title>
    <?php if (isset($styles)) { ?>
        <?php foreach ($styles as $style) { ?>
            <link rel="stylesheet" type="text/css" href="../client/style/<?= $style ?>"/>
            <script src="https://kit.fontawesome.com/74fed0e2b5.js" crossorigin="anonymous"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
            <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
        <?php } ?>
    <?php } ?>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;800&display=swap" rel="stylesheet">
    <?php
        use App\Abstract\FlashMessage;
        $flashes = FlashMessage::getFlashes('error');
    ?>
</head>
<body>
<?= $content ?? "" ?>
<script>
    <?php foreach ($flashes AS $flash){ echo 'toastr.error("'.$flash.'");'; } ?>
</script>
</body>
</html>