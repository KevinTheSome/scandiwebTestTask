<?php

namespace Src\model;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use Src\model\Model;
use Src\model\AttributeSet;
use Src\model\Price;

class Product extends Model
{
    protected $table = 'attributes';

    public function getType()
    {
        return new ObjectType([
            'name' => 'Product',
            'fields' => [
                'id' => Type::nonNull(Type::string()),
                'name' => Type::nonNull(Type::string()),
                'inStock' => Type::boolean(),
                'gallery' => Type::listOf(Type::string()),
                'description' => Type::string(),
                'category' => Type::string(),
                'attributes' => Type::listOf((new AttributeSet())->getType()),
                'prices' => Type::listOf((new Price())->getType()),
                'brand' => Type::string(),
                '__typename' => Type::string(),
            ]
        ]);
    }
}
