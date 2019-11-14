<?php

namespace App\Controllers\Admin;

use App\Models\Comment;
use Core\App;

class CommentsController extends BaseController
{
    /**
     * CommentsController constructor.
     */
    public function __construct()
    {
        $this->handleUnauthorizedUser();
    }

    /**
     * Collect approved and pending comments
     * Show view
     */
    public function showComments()
    {
        $approved = ( new Comment )->selectByApprovalStatus(true);
        $pending = ( new Comment )->selectByApprovalStatus(false);

        return view('admin/comments', compact('approved', 'pending'));
    }

    /**
     * Approve comment
     */
    public function approve()
    {
        ( new Comment() )->approve($_POST);

        App::get('session')->set('success', 'You successfully approved comment');

        return redirect('/admin/comments');
    }

    /**
     * Deny comment and delete it from database
     */
    public function delete()
    {
        ( new Comment() )->delete($_POST);

        App::get('session')->set('success', 'You successfully deleted comment');

        return redirect('/admin/comments');
    }

}