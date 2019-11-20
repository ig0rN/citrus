<?php


namespace App\RequestValidation;


interface RequestValidationInterface
{
    public function validate(array $data);
}