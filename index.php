<?php

function dd(...$vars) {
    echo '<pre>';
    foreach ($vars as $var) {
        var_dump($var);
    }
    echo '</pre>';
    die;
}

require_once __DIR__ . '/vendor/autoload.php';

new App\Core\First;