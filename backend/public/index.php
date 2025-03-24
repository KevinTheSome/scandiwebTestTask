<?php

use Src\controllers\DotEnvController;
use Src\Router;

require_once __DIR__ . '/../vendor/autoload.php';

(new DotEnvController)->load(__DIR__ . '/../');
(new Router);

// example of using environment variables remeber
// echo getenv('TEST');
// echo $_ENV['TEST'];
