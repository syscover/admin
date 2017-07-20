<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class FieldInput extends GraphQLType
{
    protected $attributes = [
        'name'          => 'FieldInput',
        'description'   => 'FieldInput that user can to do in application, this is for set permissions'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The id of field'
            ],
            'lang_id' => [
                'type' => Type::string(),
                'description' => 'The lang of label of this field'
            ],
            'field_group_id' => [
                'type' => Type::int(),
                'description' => 'The id of field group'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of field'
            ],
            'label' => [
                'type' => Type::string(),
                'description' => 'The labels for this '
            ],
            'field_type_id' => [
                'type' => Type::string(),
                'description' => 'The field type id, can to be a select, input, date, etc.'
            ],
            'data_type_id' => [
                'type' => Type::int(),
                'description' => 'The data type of custom field, can to be a int, string, float, etc.'
            ],
            'required' => [
                'type' => Type::boolean(),
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
            ]
        ];
    }
}