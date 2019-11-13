<?php


namespace App\Controllers;


class PageController
{
    public function home()
    {
        require_once 'app/views/front/home.view.php';
    }

    public function test()
    {
        echo 'test';
    }
}