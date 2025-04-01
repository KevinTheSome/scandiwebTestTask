<?php

namespace Src\controllers;

use Src\database\Database;

abstract class Controller
{
    protected $database;
    public function __construct()
    {
        $this->database = new Database();
    }
}
