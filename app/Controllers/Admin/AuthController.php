<?php

namespace App\Controllers\Admin;

use App\Models\User;
use App\RequestValidation\LoginRequest;
use Core\App;

class AuthController extends BaseController
{
    /**
     * AuthController constructor.
     */
    public function __construct()
    {
        $this->handleAuthorizedUser();
    }

    /**
     * Displays admin login form
     *
     * @return mixed
     */
    public function showLogin()
    {
        return view('/admin/auth/login');
    }

    /**
     * Collect data
     * Validate data
     * Call method for login logic
     */
    public function login()
    {
        $validation = ( new LoginRequest() )->validate($_POST);

        if (!$validation->passed()) {
            App::get('session')->set('errors', $validation->errors());

            return redirect('/admin/login');
        }

        $user = User::findBy('username', $_POST['username']);

        return $this->attempLogin($user, $_POST);
    }

    /**
     * Check user's credentials
     * Display errors if exists or login user
     * Make redirection
     *
     * @param $user
     * @param $var
     */
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

    /**
     * Logout user
     * Delete admin_user from session
     * Redirect user
     */
    public function logout()
    {
        App::get('session')->delete('admin_user');
        return redirect('/');
    }
}