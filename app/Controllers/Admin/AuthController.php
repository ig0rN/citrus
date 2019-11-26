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
            return redirect('/admin/login', ['errors' => $validation->errors()]);
        }

        $user = User::findBy('username', $_POST['username']);

        return $this->attemptLogin($user, $_POST);
    }

    /**
     * Check user's credentials
     * Display errors if exists or login user
     * Make redirection
     *
     * @param $user
     * @param $var
     */
    private function attemptLogin($user, $var)
    {
        if (! $user) {
            return redirect('/admin/login', ['error' => 'No user with username: ' . $var['username']]);
        }

        if (password_verify($var['password'], $user->password)) {
            App::get('session')->set('admin_user', $user);
            return redirect('/admin/home');
        }

        return redirect('/admin/login', ['error' => 'Incorrect password']);
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