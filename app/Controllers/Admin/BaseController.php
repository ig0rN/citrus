<?php

namespace App\Controllers\Admin;

use Core\App;

abstract class BaseController
{
    /**
     * Handle user who isn't logged
     */
    protected function handleUnauthorizedUser()
    {
        if (! App::get('session')->has('admin_user')) {
            return redirect('/admin/login', ['error' => 'You need to login']);
        }
    }

    /**
     * Handle user who is logged
     */
    protected function handleAuthorizedUser()
    {
        if (App::get('session')->has('admin_user')) {
            return redirect('/admin/home');
        }
    }
}