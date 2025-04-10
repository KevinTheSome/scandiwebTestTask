<?php

namespace Src\routes;

use Src\controllers\GraphQLController;
use Src\controllers\TestController;

class Api
{
    public function __construct()
    {
        switch ($_SERVER['REQUEST_URI']) {
            case '/test':
                return (new TestController)->index();
                break;
            case '/graphql':
                return (new GraphQLController)->get();
                break;
            default:
                echo "404";
                http_response_code(404);
                break;
        }
    }
}
