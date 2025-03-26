<?php

namespace Src\model;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use Src\model\Model;
use Src\model\Currency;

class Price extends Model
{
    protected $table = 'attributes';

    public function getType()
    {
        return new ObjectType([
            'name' => 'Price',
            'fields' => [
                'amount' => Type::float(),
                'currency' => Type::nonNull((new Currency)->getType()),
                '__typename' => Type::string(),
            ]
        ]);
    }
}
