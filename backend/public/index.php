<?php

use Src\controllers\DotEnvController;
use Src\routes\Api;

require_once __DIR__ . '/../vendor/autoload.php';

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: *');

header("Access-Control-Allow-Headers: *");

(new DotEnvController)->load(__DIR__ . '/../');

(new Api);
