<?php

namespace App\RequestValidation;

use Core\Validation;

class LoginRequest extends Validation implements RequestValidationInterface
{
    /**
     * @param array $data
     * @return LoginRequest
     */
    public function validate(array $data)
    {
        $validation = $this->check($data, array(
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