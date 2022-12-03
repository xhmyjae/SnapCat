<?php

require_once('src/controllers/homepage.php');

use App\Controllers\Homepage\Homepage;
use Application\Model\Post\PostRepository;
use Application\Model\Session\Session;

try {
    $action = $_SERVER['QUERY_STRING'] ?? '';

    switch ($action) {
        case 'login':
            (new Session())->execute();
    }

    (new Homepage())->execute();

} catch (Exception $e) {
    global $error;
    $error = $e->getMessage();

    (new Homepage())->execute();
}
