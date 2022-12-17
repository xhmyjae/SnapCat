<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?? "" ?></title>
    <?php if (isset($styles)) { ?>
        <?php foreach ($styles as $style) { ?>
            <link rel="stylesheet" type="text/css" href="../client/style/<?= $style ?>"/>
        <?php } ?>
    <?php } ?>
    <script src="client/scripts/comment.js"></script>
    <script src="https://kit.fontawesome.com/74fed0e2b5.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    <script src="https://twemoji.maxcdn.com/v/14.0.2/twemoji.min.js"
            integrity="sha384-32KMvAMS4DUBcQtHG6fzADguo/tpN1Nh6BAJa2QqZc6/i0K+YPQE+bWiqBRAWuFs"
            crossorigin="anonymous"></script
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php

    use App\Abstract\FlashMessage;

    $flashes = FlashMessage::getFlashes('error');
    ?>
</head>
<body>
<?= $content ?? "" ?>
<script>
    twemoji.parse(document.body);
    <?php foreach ($flashes as $flash) {
        echo 'toastr.error("' . $flash . '");';
    } ?>
</script>
</body>
</html>