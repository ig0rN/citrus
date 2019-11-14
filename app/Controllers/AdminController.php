<?php

namespace App\Controllers;

use Core\App;

class AdminController
{
    public function __construct()
    {
        $session = App::get('session');

        if (! $session->has('admin_user')) {
            $session->set('error', 'You need to login');

            return redirect('/admin/login');
        }
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