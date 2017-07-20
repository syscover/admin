<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class FieldGroupInput extends GraphQLType
{
    protected $attributes = [
        'name'          => 'FieldGroupInput',
        'description'   => 'A field group'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The id of field group'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of field group'
            ],
            'resource_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The root of field group'
            ]
        ];
    }
}