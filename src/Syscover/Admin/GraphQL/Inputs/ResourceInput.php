<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class ResourceInput extends GraphQLType
{
    protected $inputObject = true;

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
            ]
        ];
    }
}