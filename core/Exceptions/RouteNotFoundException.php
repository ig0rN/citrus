<?php


namespace Core\Exceptions;


class RouteNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct(
            'No route defined for this URL.',
            404
        );
    }
}