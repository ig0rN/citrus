<?php

namespace App\RequestValidation;

use Core\Validation;

class ProductRequest extends Validation implements RequestValidationInterface
{
    /**
     * @param array $data
     * @return ProductRequest
     */
    public function validate(array $data)
    {
        $validation = $this->check($data, array(
            'name|Full name' => array(
                'required' => true,
                'min' => 3,
                'max' => 35,
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
