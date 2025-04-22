<?php

namespace Src\model;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;

use Src\model\Model;
use Src\model\AttributeSetModel;
use Src\model\PriceModel;
use Src\controllers\PriceController;
use Src\controllers\GalleryController;

class ProductModel extends Model
{
    protected $table = 'Products';

    public function getType()
    {
        return new ObjectType([
            'name' => 'Product',
            'fields' => [
                'product_id' => Type::nonNull(Type::string()),
                'name' => Type::nonNull(Type::string()),
                'inStock' => Type::boolean(),
                'gallery' => [
                    'type' => Type::listOf((new GalleryModel())->getType()),
                    'resolve' => function ($root, array $args) {
                        return (new GalleryController())->get((new GalleryController())->getArreyValue($root, 'product_id'));
                    }
                ],
                'description' => Type::string(),
                'category' => Type::string(),
                'attributes' => Type::listOf((new AttributeSetModel())->getType()),
                'prices' => [
                    'type' => Type::listOf((new PriceModel())->getType()),
                    'resolve' => function ($root, array $args) {
                        return (new PriceController())->get((new PriceController())->getArreyValue($root, 'product_id'));
                    }
                ],
                'brand' => Type::string(),
                '__typename' => Type::string(),
            ]
        ]);
    }
}
