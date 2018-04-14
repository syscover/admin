<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ConfigFieldTypeOptionType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'ConfigFieldTypeOptionType',
        'description'   => 'Options defined in app/config files'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of config'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of config'
            ],
            'values' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'The name of config'
            ]
        ];
    }

    public function interfaces()
    {
        return [
            GraphQL::type('CoreConfigInterface')
        ];
    }
}