<?php

namespace App\Controllers\Admin;

use App\Models\Comment;
use Core\App;

class HomeController extends BaseController
{
    public function __construct()
    {
        $this->handleUnauthorizedUser();
    }

    public function index()
    {
        return view('admin/home');
    }

    public function redirect()
    {
        return redirect('/admin/home');
    }
}