<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class TerritorialArea3Type extends GraphQLType
{
    protected $attributes = [
        'name'          => 'TerritorialArea3',
        'description'   => 'Territorial area 3'
    ];

    public function fields()
    {
        return [
            'ix' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The index of territorial area 3'
            ],
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of territorial area 3'
            ],
            'country_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'country of territorial area 3'
            ],
            'territorial_area_1_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'territorial area 1 of territorial area 3'
            ],
            'territorial_area_2_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'territorial area 2 of territorial area 3'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of territorial area 3'
            ]
        ];
    }
}