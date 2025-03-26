<?php

namespace Src\routes;

use Src\controllers\GraphQLController;

class Api
{
    public function __construct()
    {
        switch ($_SERVER['REQUEST_URI']) {
            case '/test':
                echo "test";
                break;
            case '/graphql':
                (new GraphQLController)->graphql();
                break;
            default:
                echo "404";
                http_response_code(404);
                break;
        }
    }
}
