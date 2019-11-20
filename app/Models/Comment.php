<?php

namespace App\Models;

use Core\Database;
use Core\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_name', 'user_email', 'content', 'approved'];

    public function approve()
    {
        return $this->update(['approved' => 1]);
    }
}