<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ProfileType extends GraphQLType {

    protected $attributes = [
        'name' => 'Profile',
        'description' => 'Profile to set permissions to a user'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The id of profile'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of profile'
            ]
        ];
    }
}