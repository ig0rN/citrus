<?php

namespace App\Controllers\Admin;

use App\Models\Comment;
use Core\App;

class HomeController extends BaseController
{
    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->handleUnauthorizedUser();
    }

    /**
     * Show admin home view
     */
    public function index()
    {
        return view('admin/home');
    }

    /**
     * Redirect user
     */
    public function redirect()
    {
        return redirect('/admin/home');
    }
}