<?php

namespace Src\controllers;

class CurrencyController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($currencyLabel = null)
    {
        if (empty($currencyLabel)) {
            return $this->database->query('SELECT * FROM currencies');
        } else {
            return $this->database->query('SELECT * FROM currencies WHERE currency_label = :currency_label', ['currency_label' => $currencyLabel]);
        }
    }
}
