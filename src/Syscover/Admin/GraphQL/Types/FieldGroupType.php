<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class FieldGroupType extends GraphQLType
{
    protected $attributes = [
        'name' => 'FieldGroup',
        'description' => 'A field group, valid to group custom fields'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of field group'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of field group'
            ],
            'resource_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The root of field group'
            ],
            'resource' => [
                'type' => GraphQL::type('AdminResource'),
                'description' => 'Resource of field group'
            ]
        ];
    }

    public function interfaces() {
        return [GraphQL::type('CoreObjectInterface')];
    }
}