<?php

namespace Src\controllers;

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($ProductName = null)
    {
        if (empty($ProductName)) {
            return $this->database->query('SELECT * FROM products');
        } else {
            return $this->database->query('SELECT * FROM products WHERE name = :name', ['name' => $ProductName]);
        }
    }
}
