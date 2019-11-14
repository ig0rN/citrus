<?php

namespace Core;

class Request
{
    /**
     * Filter current URL and returns it
     *
     * @return string
     */
    public static function uri()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');

        return parse_url($url, PHP_URL_PATH);
    }

    /**
     * Return current request method
     *
     * @return string
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }
}