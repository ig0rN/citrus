<?php

function dd(...$vars) {
    echo '<pre>';
    foreach ($vars as $var) {
        var_dump($var);
    }
    echo '</pre>';
    die;
}

function redirect(string $path) {
    header("Location: {$path}");
}

function view(string $path, array $data = []) {
    extract($data);

    return require_once ROOT_DIR . "/app/views/{$path}.view.php";
}

function asset(string $path) {
    $protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';
    $rootUrl = $_SERVER['SERVER_NAME'];

    $url = "{$protocol}://{$rootUrl}/public/";

    return  $url . $path;
}
