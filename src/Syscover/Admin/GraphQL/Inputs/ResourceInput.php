<?php namespace Syscover\Admin\GraphQL\Inputs;

use Syscover\Admin\GraphQL\Types\ResourceType;
use GraphQL\Type\Definition\Type;

class ResourceInput extends ResourceType
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