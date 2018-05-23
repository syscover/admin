<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class UserInput extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'User that can login in application'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The id of user'
            ],
            'lang_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Language of user'
            ],
            'profile_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Profile to set permissions of user'
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'check if user can to access'
            ],
            'user' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Username of user'
            ],
            'password' => [
                'type' => Type::string(),
                'description' => 'Password of user'
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email of user'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of user'
            ],
            'surname' => [
                'type' => Type::string(),
                'description' => 'The surname of user'
            ]
        ];
    }
}