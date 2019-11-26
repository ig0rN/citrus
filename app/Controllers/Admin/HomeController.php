<?php

namespace App\Controllers\Admin;

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
        $user = App::get('session')->get('admin_user')->username;

        return view('admin/home', compact('user'));
    }

    /**
     * Redirect user
     */
    public function redirect()
    {
        return redirect('/admin/home');
    }
}