<?php

namespace App\Models;

use Core\Database;

class Product
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

    public function selectAll()
    {
        return $this->db->query("
            SELECT * FROM products
            ORDER BY name ASC
        ")->resultSet();
    }

    public function save(array $post)
    {
        return $this->db->query("
            INSERT INTO products (name, description, image_path) VALUES (:name, :description, :image_path)
        ")
            ->bind(':name', $post['name'])
            ->bind(':description', $post['description'])
            ->bind(':image_path', $post['image_path'])
            ->execute();
    }

    public function find(array $post)
    {
        return $this->db->query("
            SELECT * FROM products
            WHERE id = :id
        ")
            ->bind(':id', $post['id'])
            ->single();
    }

    public function update(array $post)
    {
        return $this->db->query("
            UPDATE products SET name = :name, description = :description
            WHERE id = :id
        ")
            ->bind(':name', $post['name'])
            ->bind(':description', $post['description'])
            ->bind(':id', $post['id'])
            ->execute();
    }

    public function delete(array $post)
    {
        $image = $this->db->query("
            SELECT image_path as image FROM products
            WHERE id = :id
        ")
            ->bind(':id', $post['id'])
            ->single()
            ->image;

        $path = ROOT_DIR . '/public/images/' . $image;
        if (file_exists($path)) {
            unlink($path);
        }

        return $this->db->query("
            DELETE FROM products WHERE id = :id
        ")
            ->bind(':id', $post['id'])
            ->execute();
    }
}