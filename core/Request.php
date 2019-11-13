<?php


namespace Core;


class Request
{

    public static function uri()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');

        return parse_url($url, PHP_URL_PATH);
    }

    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

}