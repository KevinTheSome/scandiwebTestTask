<?php

namespace Src\model;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use Src\model\Model;
use Src\model\CurrencyModel;

class PriceModel extends Model
{
    protected $table = 'attributes';

    public function getType()
    {
        return new ObjectType([
            'name' => 'Price',
            'fields' => [
                'amount' => Type::float(),
                'currency' => Type::nonNull((new CurrencyModel)->getType()),
                '__typename' => Type::string(),
            ]
        ]);
    }
}
