<?php

namespace Src\controllers;

class PriceController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($productId = null)
    {
        if (empty($productId)) {
            return $this->database->query('SELECT * FROM prices');
        } else {
            return $this->database->query('SELECT * FROM prices WHERE product_id = :product_id', ['product_id' => $productId]);
        }
    }
}
