<?php

namespace Src\controllers;

class GalleryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($productId = null)
    {
        if (empty($product_id)) {
            return $this->database->query('SELECT * FROM product_Gallery');
        } else {
            return $this->database->query('SELECT * FROM product_Gallery WHERE product_id = :product_id', ['product_id' => $product_id]);
        }
    }
}
