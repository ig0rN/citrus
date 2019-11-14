<?php

namespace App\Controllers\Admin;

use App\Models\Comment;
use Core\App;

class CommentsController extends BaseController
{
    public function __construct()
    {
        $this->handleUnauthorizedUser();
    }

    public function showComments()
    {
        $approved = ( new Comment )->selectByApprovalStatus(true);
        $pending = ( new Comment )->selectByApprovalStatus(false);

        return view('admin/comments', compact('approved', 'pending'));
    }

    public function approve()
    {
        ( new Comment() )->approve($_POST);

        App::get('session')->set('success', 'You successfully approved comment');

        return redirect('/admin/comments');
    }

    public function delete()
    {
        ( new Comment() )->delete($_POST);

        App::get('session')->set('success', 'You successfully deleted comment');

        return redirect('/admin/comments');
    }

}