<?php

require_once('src/controllers/homepage.php');

use App\Controllers\Homepage\Homepage;
use Application\Model\Post\PostRepository;

try {
    /**
     * @type string $action
     */
    $action = $_SERVER['QUERY_STRING'] ?? '';

    (new Homepage())->execute();

} catch (Exception $e) {
    global $error;
    $error = $e->getMessage();

    (new Homepage())->execute();
}
