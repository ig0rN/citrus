<?php

namespace App\RequestValidation;

use Core\Validation;

class LoginRequest extends Validation implements ValidationRequestInterface
{
    public function validate($var)
    {
        $validation = $this->check($var, array(
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