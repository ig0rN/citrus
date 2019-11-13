<?php


namespace Core\Exceptions;


use Throwable;

abstract class Exception extends \Exception
{

    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return "Error {$this->getCode()}: {$this->getMessage()}";
    }

    /**
     * Return error message to the client in the json format
     *
     * @param bool $json
     */
    public function print($json = false)
    {
        http_response_code($this->getCode());

        if ($json)
        {
            header("Content-Type: application/json");

            echo json_encode([
                'code' => $this->getCode(),
                'message' => $this->getMessage()
            ]);
        }
        else
        {
            echo $this->__toString();
        }
    }

}