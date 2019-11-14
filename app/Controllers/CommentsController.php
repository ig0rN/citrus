<?php


namespace App\Controllers;


use App\RequestValidation\CommentRequest;
use Core\App;
use Core\Database;

class CommentsController
{
    public function store()
    {

        $validation = ( new CommentRequest() )->validate($_POST);
        $session = App::get('session');

        if (!$validation->passed()) {
            $session->set('errors', $validation->errors());

            return redirect('/');
        }

        $db = new Database();

        $result = $db->query(
            "INSERT INTO comments (user_name, user_email, content) VALUES (:user_name,:user_email,:content)"
        )
            ->bind(':user_name', $_POST['name'])
            ->bind(':user_email', $_POST['email'])
            ->bind(':content', $_POST['comment'])
            ->execute();

        if ($result) {
            $session->set('success', 'You successfuly send comment. Now you wait for admin to approve');
        } else {
            $session->set('error', 'Somethings went wrong');
        }

        return redirect('/');
    }
}