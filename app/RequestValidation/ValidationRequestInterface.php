<?php


namespace App\RequestValidation;


interface ValidationRequestInterface
{
    public function validate($data);
}