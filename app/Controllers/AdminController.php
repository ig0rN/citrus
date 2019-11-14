<?php

namespace App\Controllers;

use App\Models\Comment;
use Core\App;

class AdminController
{
    public function __construct()
    {
        if (! App::get('session')->has('admin_user')) {
            App::get('session')->set('error', 'You need to login');

            return redirect('/admin/login');
        }
    }

    public function index()
    {
        return view('admin/home');
    }

    public function showComments()
    {
        $approved = ( new Comment )->selectByApprovalStatus(true);
        $pending = ( new Comment )->selectByApprovalStatus(false);

        return view('admin/comments', compact('approved', 'pending'));
    }

    public function redirect()
    {
        return redirect('/admin/home');
    }
}