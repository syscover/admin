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
                'type' => Type::int(),
                'description' => 'The id of package'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of package'
            ],
            'root' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The root of package'
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'Set if package is active'
            ],
            'sort' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Sort package'
            ]
        ];
    }
}