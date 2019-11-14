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
            SELECT id, user_name AS name, user_email AS email, content
            FROM comments
            WHERE approved = $value
            ORDER BY id DESC
        ")->resultSet();
    }

    public function addComment(array $post): bool
    {
        return $this->db->query(
            "INSERT INTO comments (user_name, user_email, content) VALUES (:user_name,:user_email,:content)"
        )
        ->bind(':user_name', $post['name'])
        ->bind(':user_email', $post['email'])
        ->bind(':content', $post['comment'])
        ->execute();
    }

    public function approve(array $post)
    {
        return $this->db->query("
            UPDATE comments SET approved = 1 WHERE id = :id
        ")
            ->bind(':id', $post['id'])
            ->execute();
    }

    public function delete(array $post)
    {
        return $this->db->query("
            DELETE FROM comments WHERE id = :id
        ")
            ->bind(':id', $post['id'])
            ->execute();
    }

}