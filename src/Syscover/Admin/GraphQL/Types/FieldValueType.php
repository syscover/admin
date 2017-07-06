<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class FieldValueType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'FieldValueType',
        'description'   => 'A custom field value'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of field value'
            ],
            'lang_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id language of field value'
            ],
            'field_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The field that belong this value'
            ],
            'counter' => [
                'type' => Type::int(),
                'description' => 'Counter to assign ids to values'
            ],
            'sort' => [
                'type' => Type::int(),
                'description' => 'Sort values'
            ],
            'featured' => [
                'type' => Type::boolean(),
                'description' => 'Check if this value is featured'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'Name of field value'
            ],
            'data_lang' => [
                'type' => Type::listOf(Type::string()),
                'description' => 'JSON string that contain information about object translations'
            ]
        ];
    }

    public function interfaces() {
        return [GraphQL::type('CoreObjectInterface')];
    }
}