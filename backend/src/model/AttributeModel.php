<?php

namespace Src\model;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use Src\model\Model;

class AttributeModel extends Model
{
    protected $table = 'attributes';

    public function getType()
    {
        return new ObjectType([
            'name' => 'Attribute',
            'fields' => [
                'displayValue' => Type::string(),
                'value' => Type::string(),
                'id' => Type::string(),
                '__typename' => Type::string(),
            ]
        ]);
    }
}
