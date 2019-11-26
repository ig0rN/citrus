<?php

namespace App\RequestValidation;

use Core\Validation;

class CommentRequest extends Validation implements RequestValidationInterface
{
    /**
     * @param array $data
     * @return CommentRequest
     */
    public function validate(array $data)
    {
        $validation = $this->check($data, array(
            'user_name|Full name' => array(
                'required' => true,
                'min' => 3,
                'max' => 35,
            ),
            'user_email|Email' => array(
                'required' => true,
                'min' => 7,
            ),
            'content|Description' => array(
                'required' => true,
                'min' => 6,
                'max' => 80
            )
        ));

        return $validation;
    }
}
