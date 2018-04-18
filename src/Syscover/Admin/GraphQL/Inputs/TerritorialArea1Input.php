<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class TerritorialArea1Input extends GraphQLType
{
    protected $attributes = [
        'name'          => 'TerritorialArea1',
        'description'   => 'Territorial area 1'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'ix' => [
                'type' => Type::int(),
                'description' => 'The index of territorial area 1'
            ],
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
            ],
            'slug' => [
                'type' => Type::string(),
                'description' => 'The slug of territorial area 1'
            ]
        ];
    }
}