<?php

namespace App\RequestValidation;

use Core\Validation;

class CommentRequest implements ValidationRequestInterface {
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
            'name|Full name' => array(
                'required' => true,
                'min' => 3,
                'max' => 35,
            ),
            'email|Email' => array(
                'required' => true,
                'min' => 7,
            ),
            'description|Description' => array(
                'required' => true,
                'min' => 6,
                'max' => 80
            )
        ));

        return $validation;
    }
}
