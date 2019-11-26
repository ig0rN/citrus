<?php

namespace App\Models;

use Core\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['user_name', 'user_email', 'content', 'approved'];

    public function approve()
    {
        $this->approved = 1;

        return $this->update();
    }
}