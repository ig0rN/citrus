<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\RequestValidation\LoginRequest;
use Core\App;

class AuthController extends BaseController
{

    public function __construct()
    {
        $this->handleAuthorizedUser();
    }

    public function showLogin()
    {
        return view('/admin/auth/login');
    }

    public function login()
    {
        $validation = ( new LoginRequest() )->validate($_POST);

        if (!$validation->passed()) {
            App::get('session')->set('errors', $validation->errors());

            return redirect('/admin/login');
        }

        $user = ( new User() )->getByUsername($_POST);

        $this->attempLogin($user, $_POST);
    }

    private function attempLogin($user, $var)
    {
        if (! $user) {
            App::get('session')->set('error', "No user with username: {$var['username']}");
            return redirect('/admin/login');
        }

        if (password_verify($var['password'], $user->password)) {
            App::get('session')->set('admin_user', $user);
            return redirect('/admin/home');
        }

        App::get('session')->set('error', 'Incorrect password');

        return redirect('/admin/login');
    }

    public function logout()
    {
        App::get('session')->delete('admin_user');
        return redirect('/');
    }
}