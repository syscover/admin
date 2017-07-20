<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class LangType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Lang',
        'description'   => 'Lang for application.'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of lang'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of lang'
            ],
            'icon' => [
                'type' => Type::nonNull(Type::string()),
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

    public function interfaces() {
        return [GraphQL::type('CoreObjectInterface')];
    }
}