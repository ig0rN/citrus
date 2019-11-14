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

    public function addComment(array $var): bool
    {
        return $this->db->query(
            "INSERT INTO comments (user_name, user_email, content) VALUES (:user_name,:user_email,:content)"
        )
        ->bind(':user_name', $var['name'])
        ->bind(':user_email', $var['email'])
        ->bind(':content', $var['comment'])
        ->execute();
    }

}