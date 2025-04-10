<?php

namespace Src\controllers;

use Src\database\Database;

abstract class Controller
{
    protected $database;

    abstract public function get();

    public function getArreyValue($array, $key)
    {
        return isset($array[$key]) ? $array[$key] : null;
    }
    public function __construct()
    {
        $this->database = new Database();
    }
}
