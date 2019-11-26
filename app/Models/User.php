<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    protected $table = 'admin_users';
    protected $fillable = ['username', 'password'];
}