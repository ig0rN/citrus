<?php

namespace App\Models;

use Core\Database;

class Product
{
    /**
     * @var Database
     */
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function selectAll()
    {
        return $this->db->query("
            SELECT * FROM products
        ")->resultSet();
    }
}