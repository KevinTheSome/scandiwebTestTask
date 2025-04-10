<?php

namespace Src\controllers;

class TestController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        var_dump(self::index());
    }

    public function index()
    {
        return $this->database->query('CREATE TABLE IF NOT EXISTS categories (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL);');
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
