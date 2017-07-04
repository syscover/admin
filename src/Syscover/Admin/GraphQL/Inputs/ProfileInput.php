<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ProfileInput extends GraphQLType
{
    protected $attributes = [
        'name'          => 'Profile',
        'description'   => 'Profile to set permissions to a user'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of profile'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of profile'
            ]
        ];
    }
}