<?php

require_once('src/controllers/homepage.php');

use App\Controllers\Homepage\Homepage;

try {
    $homepage = new Homepage();
    $homepage->execute();
} catch (Exception $e) {
    echo $e->getMessage();
}

