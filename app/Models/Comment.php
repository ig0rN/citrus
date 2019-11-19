<?php

namespace App\Models;

use Core\Database;
use Core\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_name', 'user_email', 'content'];

    public function approve()
    {
        return Database::getInstance()->query("
            UPDATE {$this->table} SET approved = 1 WHERE id = {$this->id}
        ")
            ->execute();
    }
}