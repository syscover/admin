<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class LangInput extends GraphQLType
{
    protected $attributes = [
        'name'          => 'LangInput',
        'description'   => 'Lang for application.'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'ix' => [
                'type' => Type::int(),
                'description' => 'The index of lang'
            ],
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of lang'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of lang'
            ],
            'icon' => [
                'type' => Type::string(),
                'description' => 'The icon of lang'
            ],
            'sort' => [
                'type' => Type::int(),
                'description' => 'The icon of lang'
            ],
            'active' => [
                'type' => Type::boolean(),
                'description' => 'Register if lang is active'
            ]
        ];
    }
}