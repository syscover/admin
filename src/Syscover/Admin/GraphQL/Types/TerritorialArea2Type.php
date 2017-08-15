<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class TerritorialArea2Type extends GraphQLType
{
    protected $attributes = [
        'name'          => 'TerritorialArea2',
        'description'   => 'Territorial area 2'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of territorial area 2'
            ],
            'country_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'country of territorial area 2'
            ],
            'territorial_area_1_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'territorial area 1 of territorial area 2'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of territorial area 2'
            ]
        ];
    }
}