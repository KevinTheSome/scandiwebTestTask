<?php

namespace Src\model;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use Src\model\Model;
use Src\model\Attribute;

class AttributeSet extends Model
{
    protected $table = 'attributes';

    public function getType()
    {
        return new ObjectType([
            'name' => 'AttributeSet',
            'fields' => [
                'id' => Type::string(),
                'name' => Type::string(),
                'type' => Type::string(),
                'items' => Type::listOf((new Attribute)->getType()),
                '__typename' => Type::string(),
            ]
        ]);
    }
}
