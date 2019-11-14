<?php


namespace App\Controllers;


use App\Models\Comment;
use App\RequestValidation\CommentRequest;
use Core\App;

class CommentsController
{
    public function store()
    {
        $session = App::get('session');
        $validation = ( new CommentRequest() )->validate($_POST);

        if (!$validation->passed()) {
            $session->set('errors', $validation->errors());

            return redirect('/');
        }

        $result = ( new Comment() )->addComment($_POST);

        if ($result) {
            $session->set('success', 'You successfuly send comment. Now you wait for admin to approve');
        } else {
            $session->set('error', 'Somethings went wrong');
        }

        return redirect('/');
    }
}