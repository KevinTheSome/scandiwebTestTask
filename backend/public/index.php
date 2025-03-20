<?php

use Src\Test;

require_once __DIR__ . '/../vendor/autoload.php';

var_dump(class_exists('Src\Test'));

(new Test());
