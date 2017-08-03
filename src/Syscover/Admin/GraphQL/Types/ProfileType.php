<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Syscover\Core\GraphQL\ScalarTypes\AnyType;

class ProfileType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Profile',
        'description'   => 'Profile to set permissions to a user'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(app(AnyType::class)),
                'description' => 'The id of profile'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of profile'
            ]
        ];
    }

    public function interfaces() {
        return [GraphQL::type('CoreObjectInterface')];
    }
}