<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Syscover\Core\GraphQL\ScalarTypes\AnyType;

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
                'type' => Type::nonNull(app(AnyType::class)),
                'description' => 'The id of action'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of action'
            ]
        ];
    }

    public function interfaces() {
        return [GraphQL::type('CoreObjectInterface')];
    }
}