<?php

namespace App\Models;

use Core\Database;

class User
{
    /**
     * @var Database
     */
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getByUsername(array $var)
    {
        return $this->db->query("
            SELECT * FROM admin_users
            WHERE username = :username
        ")
            ->bind('username', $var['username'])
            ->single();
    }
}