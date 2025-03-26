<?php

namespace Src\model;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use Src\model\Model;


class Currency extends Model
{
    protected $table = 'attributes';

    public function getType()
    {
        return new ObjectType([
            'name' => 'Currency',
            'fields' => [
                'label' => Type::string(),
                'symbol' => Type::string(),
                '__typename' => Type::string(),
            ]
        ]);
    }
}
