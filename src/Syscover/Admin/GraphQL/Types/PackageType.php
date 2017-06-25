<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class PackageType extends GraphQLType {

    protected $attributes = [
        'name' => 'Package',
        'description' => 'A package'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of action'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of action'
            ],
            'root' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of action'
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'The name of action'
            ],
            'sort' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The name of action'
            ]
        ];
    }
}