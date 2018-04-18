<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class TerritorialArea3Input extends GraphQLType
{
    protected $attributes = [
        'name'          => 'TerritorialArea3',
        'description'   => 'Territorial area 3'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'ix' => [
                'type' => Type::int(),
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
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of territorial area 3'
            ]
        ];
    }
}