<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ActionType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Action',
        'description'   => 'Action that user can to do in application, this is for set permissions'
    ];

    public function fields()
    {
        return [
            'ix' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The index of action'
            ],
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of action'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of action'
            ]
        ];
    }
}