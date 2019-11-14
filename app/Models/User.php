<?php

namespace App\Models;

use Core\Database;

class User
{
    /**
     * @var Database
     */
    private $db;

    /**
     * Comment constructor.
     * Set database instance
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    public function getByUsername(array $post)
    {
        return $this->db->query("
            SELECT * FROM admin_users
            WHERE username = :username
        ")
            ->bind(':username', $post['username'])
            ->single();
    }
}