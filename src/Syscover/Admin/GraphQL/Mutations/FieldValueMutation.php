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
            'idOld' => [
                'name' => 'idOld',
                'type' => Type::nonNull(Type::string())
            ],
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminFieldValueInput'))
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return FieldValueService::update($args['object'], $args['idOld']);
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
            'field' => [
                'name' => 'field',
                'type' => Type::nonNull(Type::int())
            ],
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string())
            ],
            'lang' => [
                'name' => 'lang',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::destroyRecord($args['id'], FieldValue::class, $args['lang']);

        return $object;
    }
}
