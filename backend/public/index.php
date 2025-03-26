<?php

use Src\controllers\DotEnvController;
use Src\routes\Api;

require_once __DIR__ . '/../vendor/autoload.php';

(new DotEnvController)->load(__DIR__ . '/../');

(new Api);
