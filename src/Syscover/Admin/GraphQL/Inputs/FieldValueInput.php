<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class FieldValueInput extends GraphQLType
{
    protected $attributes = [
        'name'          => 'FieldValueInput',
        'description'   => 'A custom field value'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of field value'
            ],
            'lang_id' => [
                'type' => Type::id(),
                'description' => 'The id language of field value'
            ],
            'field_id' => [
                'type' => Type::id(),
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
}