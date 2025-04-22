<?php

namespace Src\model;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use Src\model\Model;
use Src\model\CurrencyModel;
use Src\controllers\CurrencyController;

class PriceModel extends Model
{
    protected $table = 'Prices';

    public function getType()
    {
        return new ObjectType([
            'name' => 'Price',
            'fields' => [
                'amount' => Type::float(),
                'currency_label' => Type::string(),
                'currency' => [
                    'type' => Type::nonNull((new CurrencyModel)->getType()),
                    'resolve' => function ($root, array $args) {
                        return (new CurrencyController())->get((new CurrencyController())->getArreyValue($root, 'currency_label'));
                    }
                ],
                '__typename' => Type::string(),
            ]
        ]);
    }
}
