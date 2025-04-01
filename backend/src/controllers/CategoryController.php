<?php

namespace Src\controllers;

class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($categoryName = null)
    {
        if (empty($categoryName)) {
            return $this->database->query('SELECT * FROM categories');
        } else {
            return $this->database->query('SELECT * FROM categories WHERE name = :name', ['name' => $categoryName]);
        }
    }
}
