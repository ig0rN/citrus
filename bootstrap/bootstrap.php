<?php

function dd(...$vars) {
    echo '<pre>';
    foreach ($vars as $var) {
        var_dump($var);
    }
    echo '</pre>';
    die;
}

require_once ROOT_DIR . '/vendor/autoload.php';

use Core\App;

App::bind('database', require_once 'config/database.php');