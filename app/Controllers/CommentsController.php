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
    public function addComment()
    {
        $validation = ( new CommentRequest() )->validate($_POST);

        if (!$validation->passed()) {
            return redirect('/', ['error' => 'Validation failed. Try again.', 'errors' => $validation->errors()]);
        }

        Comment::create($_POST);

        return redirect('/', ['success' => 'You successfully send comment. Now you wait for admin to approve.']);
    }
}