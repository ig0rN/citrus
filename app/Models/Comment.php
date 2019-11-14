<?php


namespace App\Models;


use Core\Database;

class Comment
{
    /**
     * @var Database
     */
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function selectByApprovalStatus(bool $status)
    {
        $value = $status ? 1 : 0;

        return $this->db->query("
            SELECT user_name AS name, user_email AS email, content
            FROM comments
            WHERE approved = $value
            ORDER BY id DESC
        ")->resultSet();
    }

}