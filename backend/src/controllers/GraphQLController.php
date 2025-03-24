<?php

namespace Src\controllers;

use GraphQL\GraphQL;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use GraphQL\Type\SchemaConfig;

class GraphQLController extends Controller
{
    protected $db;
    private $queryType;
    private $mutationType;

    public function __construct($DbConnection)
    {
        parent::__construct();
        $this->db = $DbConnection;

        $this->queryType = new ObjectType([
            'name' => 'Query',
            'fields' => [
                'echo' => [
                    'type' => Type::string(),
                    'args' => [
                        'message' => ['type' => Type::string()],
                    ],
                    'resolve' => static fn($rootValue, array $args): string => $rootValue['prefix'] . $args['message'],
                ],
            ],
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
            $schema = new Schema(
                (new SchemaConfig())
                    ->setQuery($this->queryType)
                    ->setMutation($this->mutationType)
            );

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
