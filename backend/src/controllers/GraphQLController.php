<?php

namespace Src\controllers;

use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;

use Src\model\CategoryModel;
use Src\controllers\CategoryController;
use Src\model\ProductModel;
use Src\controllers\ProductController;

class GraphQLController extends Controller
{
    protected $db;
    private $queryType;
    private $mutationType;


    public function __construct()
    {
        parent::__construct();

        $this->queryType = new ObjectType([
            'name' => 'Query',
            'fields' => [
                'categories' => [
                    'type' => Type::listOf((new CategoryModel)->getType()),
                    'args' => [
                        'name' => ['type' => Type::string()],
                    ],
                    'resolve' => function ($root, array $args) {
                        return (new CategoryController())->get($this->getArreyValue($args, 'name'));
                    }
                ],
                'products' => [
                    'type' => Type::listOf((new ProductModel)->getType()),
                    'args' => [
                        'name' => ['type' => Type::string()],
                        'product_id' => ['type' => Type::string()]
                    ],
                    'resolve' => function ($root, array $args) {
                        return (new ProductController())->get($this->getArreyValue($args, 'product_id'));
                    }
                ]
            ]
        ]);

        $this->mutationType = new ObjectType([
            'name' => 'Mutation',
            'fields' => [
                'sum' => [
                    'type' => Type::int(),
                    'args' => [
                        'x' => ['type' => Type::int()],
                        'y' => ['type' => Type::int()],
                    ],
                    'resolve' => static fn($calc, array $args): int => $args['x'] + $args['y'],
                ],
            ],
        ]);
    }

    // public function graphql()
    // {
    //     header('Content-Type: application/json; charset=UTF-8');

    //     if (empty($_POST['query'])) //check if the request has a GraphQL query
    //     {
    //         echo json_encode(['error' => ['message' => 'No GraphQL query found in the HTTP request']], JSON_THROW_ON_ERROR);
    //         die();
    //     }

    //     $schema = new Schema([
    //         'query' => $this->queryType,
    //         'mutation' => $this->mutationType,
    //     ]);

    //     $query = strval($_POST['query']);

    //     $result = GraphQL::executeQuery($schema, $query);
    //     $output = $result->toArray();



    //     echo json_encode($output, JSON_THROW_ON_ERROR);
    // }

    public function get()
    {
        header('Content-Type: application/json; charset=UTF-8');

        if (empty(json_decode(file_get_contents('php://input'), true))) //check if the request has a GraphQL query
        {
            echo json_encode(['error' => ['message' => 'No GraphQL query found in the HTTP request']], JSON_THROW_ON_ERROR);
            die();
        }

        $schema = new Schema([
            'query' => $this->queryType,
            'mutation' => $this->mutationType,
        ]);

        $query = json_decode(file_get_contents('php://input'), true);
        $result = GraphQL::executeQuery($schema, $query['query']);
        $output = $result->toArray();



        echo json_encode($output, JSON_THROW_ON_ERROR);
    }
}
