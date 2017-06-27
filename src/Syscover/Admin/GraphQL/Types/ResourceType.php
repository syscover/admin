<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ResourceType extends GraphQLType {

    // to documentation
    protected $attributes = [
        'name' => 'Resource',
        'description' => 'Resource that user can to do in application.'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of resource'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of resource'
            ],
            'package_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Package id from resource'
            ],
            'package' => [
                'type' => GraphQL::type('AdminPackage'),
                'description' => 'Package of resource'
            ]
        ];
    }
}