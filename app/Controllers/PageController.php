<?php


namespace App\Controllers;


use Core\Database;

class PageController
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function home()
    {
        $products = $this->db->query("
            SELECT * FROM products
        ")->resultSet();


        require_once 'app/views/front/home.view.php';
    }

    public function test()
    {
    }
}