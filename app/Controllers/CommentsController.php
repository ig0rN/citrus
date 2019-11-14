<?php

namespace App\Controllers;

use App\Models\Comment;
use App\RequestValidation\CommentRequest;
use Core\App;

class CommentsController
{
    /**
     * Validate comment
     * Store comment in database
     */
    public function store()
    {
        $validation = ( new CommentRequest() )->validate($_POST);

        if (!$validation->passed()) {
            App::get('session')->set('error', 'Validation failed. Try again.git a');
            App::get('session')->set('errors', $validation->errors());

            return redirect('/');
        }

        $result = ( new Comment() )->addComment($_POST);

        if ($result) {
            App::get('session')->set('success', 'You successfully send comment. Now you wait for admin to approve');
        } else {
            App::get('session')->set('error', 'Somethings went wrong');
        }

        return redirect('/');
    }
}