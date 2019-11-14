<?php

namespace App\Controllers\Admin;

use Core\App;

abstract class BaseController
{

    protected function handleUnauthorizedUser()
    {
        if (! App::get('session')->has('admin_user')) {
            App::get('session')->set('error', 'You need to login');

            return redirect('/admin/login');
        }
    }

    protected function handleAuthorizedUser()
    {
        if (App::get('session')->has('admin_user')) {
            return redirect('/admin/home');
        }
    }
}