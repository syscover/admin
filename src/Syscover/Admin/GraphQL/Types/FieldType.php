<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Syscover\Core\GraphQL\ScalarTypes\AnyType;

class FieldType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'FieldType',
        'description'   => 'A custom field'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(app(AnyType::class)),
                'description' => 'The id of field'
            ],
            'field_group_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of field group'
            ],
            'field_group_name' => [
                'type' => Type::string(),
                'description' => 'Field group object'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of field'
            ],
            'labels' => [
                'type' => Type::nonNull(Type::listOf(GraphQL::type('CoreTranslationField'))),
                'description' => 'The labels for this field'
            ],
            'field_type_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The field type id, can to be a select, input, date, etc.'
            ],
            'field_type_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of file type'
            ],
            'data_type_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The data type of custom field, can to be a int, string, float, etc.'
            ],
            'data_type_name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of data type'
            ],
            'required' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'Set custom field like required'
            ],
            'sort' => [
                'type' => Type::int(),
                'description' => 'Sort of custom field'
            ],
            'max_length' => [
                'type' => Type::int(),
                'description' => 'Max length if custom field is a input text'
            ],
            'pattern' => [
                'type' => Type::string(),
                'description' => 'The pattern to validate custom field of data type'
            ],
            'label_class' => [
                'type' => Type::string(),
                'description' => 'The class that will be apply in label'
            ],
            'component_class' => [
                'type' => Type::string(),
                'description' => 'The class that will be apply to component class'
            ],
            'values' => [
                'type' => Type::listOf(GraphQL::type('AdminFieldValue')),
                'description' => 'The class that will be apply to component class'
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