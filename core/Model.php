<?php

namespace Core;

abstract class Model
{
    /**
     * @var Database
     */
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}