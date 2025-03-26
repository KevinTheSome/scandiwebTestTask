<?php

namespace Src\controllers;

use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;
use Src\model\Category;
use Src\model\Product;

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
                    'type' => Type::listOf((new Category)->getType()),
                    'args' => [
                        'name' => ['type' => Type::string()]
                    ],
                    'resolve' => function ($root, $args) {
                        return array_filter($root['data']['categories'], function ($category) use ($args) {
                            return empty($args['name']) || $category['name'] === $args['name'];
                        });
                    }
                ],
                'products' => [
                    'type' => Type::listOf((new Product)->getType()),
                    'args' => [
                        'category' => ['type' => Type::string()]
                    ],
                    'resolve' => function ($root, $args) {
                        return array_filter($root['data']['products'], function ($product) use ($args) {
                            return empty($args['category']) || $product['category'] === $args['category'];
                        });
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

    public function graphql()
    {

        try {
            // See docs on schema options:
            // https://webonyx.github.io/graphql-php/schema-definition/#configuration-options
            $schema = new Schema([
                'query' => $this->queryType,
                'mutation' => $this->mutationType,
                'typeLoader' => static fn($type): ?ObjectType => (new $type)->getType()
            ]);

            $input = json_decode($_POST['query'], true);

            $query = $input['query'];
            $variableValues = $input['variables'] ?? null;

            $rootValue = ['prefix' => 'You said: '];
            $result = GraphQL::executeQuery($schema, $query, $rootValue, null, $variableValues);
            $output = $result->toArray();
        } catch (\Throwable $e) {
            $output = [
                'error' => [
                    'message' => $e->getMessage(),
                ],
            ];
        }

        header('Content-Type: application/json; charset=UTF-8');
        return json_encode($output, JSON_THROW_ON_ERROR);
    }
}
