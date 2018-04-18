<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class TerritorialArea2Input extends GraphQLType
{
    protected $attributes = [
        'name'          => 'TerritorialArea2',
        'description'   => 'Territorial area 2'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'ix' => [
                'type' => Type::int(),
                'description' => 'The index of territorial area 2'
            ],
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
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of territorial area 2'
            ]
        ];
    }
}