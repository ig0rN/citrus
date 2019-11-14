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
            App::get('session')->set('error', 'You need to login');

            return redirect('/admin/login');
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