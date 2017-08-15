<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class TerritorialArea1Type extends GraphQLType
{
    protected $attributes = [
        'name'          => 'TerritorialArea1',
        'description'   => 'Territorial area 1'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of territorial area 1'
            ],
            'country_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'country of territorial area 1'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of territorial area 1'
            ]
        ];
    }
}