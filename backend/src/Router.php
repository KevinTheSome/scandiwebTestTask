<?php

namespace Src;

class Router
{
  public function __construct()
  {
    $uri = parse_url($_SERVER["REQUEST_URI"])["path"];

    $routes = require("../src/routes/api.php");
    foreach ($routes as $controller) {
      require_once "src/controllers/" . explode("@", $controller)[0] . ".php";
    }

    if (array_key_exists($uri, $routes)) {
      list($controller, $method) = explode('@', $routes[$uri]);
      $instance = new $controller();
      $instance->$method();
    } else {
      http_response_code(404);
      exit();
    }
  }
}
