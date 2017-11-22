<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\FieldValue;
use Syscover\Admin\Services\FieldValueService;
use Syscover\Core\Services\SQLService;

class FieldValueMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminFieldValue');
    }
}

class AddFieldValueMutation extends FieldValueMutation
{
    protected $attributes = [
        'name'          => 'addFieldValue',
        'description'   => 'Add new field'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminFieldValueInput'))
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return FieldValueService::create($args['object']);
    }
}

class UpdateFieldValueMutation extends FieldValueMutation
{
    protected $attributes = [
        'name'          => 'updateFieldValue',
        'description'   => 'Update field group'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminFieldValueInput'))
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return FieldValueService::update($args['object']);
    }
}

class DeleteFieldValueMutation extends FieldValueMutation
{
    protected $attributes = [
        'name'          => 'deleteFieldValue',
        'description'   => 'Delete field value'
    ];

    public function args()
    {
        return [
            'field_id' => [
                'name' => 'field_id',
                'type' => Type::nonNull(Type::int())
            ],
            'lang_id' => [
                'name' => 'lang_id',
                'type' => Type::string()
            ],
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::destroyRecord($args['id'], FieldValue::class, $args['lang_id'], null, ['field_id' => $args['field_id']]);

        return $object;
    }
}
