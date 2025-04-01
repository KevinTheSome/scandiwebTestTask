<?php

namespace Src\model;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use Src\model\Model;

class CategoryModel extends Model
{
    protected $table = 'attributes';

    public function getType()
    {
        return new ObjectType([
            'name' => 'Category',
            'fields' => [
                'name' => Type::string(),
                '__typename' => Type::string(),
            ]
        ]);
    }
}
