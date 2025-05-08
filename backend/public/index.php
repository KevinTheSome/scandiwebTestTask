<?php

use Src\controllers\DotEnvController;
use Src\routes\Api;

ini_set('display_errors', 'on');
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Methods: *');

header("Access-Control-Allow-Headers: *");

(new DotEnvController)->load(__DIR__ . '/../');

(new Api);
