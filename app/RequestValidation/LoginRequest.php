<?php

namespace App\RequestValidation;

use Core\Validation;

class LoginRequest implements ValidationRequestInterface {
    /**
     * @var ValidationRequestInterface
     */
    private $validator;

    /**
     * CommentRequest constructor.
     */
    public function __construct()
    {
        $this->validator = New Validation();
    }


    public function validate($var)
    {
        $validation = $this->validator->check($var, array(
            'username|Username' => array(
                'required' => true,
                'min' => 3,
                'max' => 35,
            ),
            'password|Password' => array(
                'required' => true
            )
        ));

        return $validation;
    }
}