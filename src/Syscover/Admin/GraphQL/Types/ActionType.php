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
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of action'
            ],
            'object_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The sting id of action'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of action'
            ]
        ];
    }
}