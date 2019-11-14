<?php

namespace Core\Exceptions;

class MethodNotFoundException extends Exception
{
    /**
     * MethodNotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct(
            'Method not found inside controller.',
            405
        );
    }
}