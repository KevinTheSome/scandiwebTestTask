<?php

namespace Src\model;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Schema;
use Src\model\Model;


class GalleryModel extends Model
{
    protected $table = 'Gallery';

    public function getType()
    {
        return new ObjectType([
            'name' => 'Gallery',
            'fields' => [
                'product_id' => Type::string(),
                'image_url' => Type::string(),
                '__typename' => Type::string(),
            ]
        ]);
    }
}
