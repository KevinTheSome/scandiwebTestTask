<?php

namespace Src\controllers;

class ProductController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($ProductId = null)
    {
        if ($ProductId === null) {
            return $this->database->query('SELECT * FROM products');
        } else {
            return $this->database->query('SELECT * FROM products WHERE product_id = :product_id', ['product_id' => $ProductId]);
        }
    }
}
