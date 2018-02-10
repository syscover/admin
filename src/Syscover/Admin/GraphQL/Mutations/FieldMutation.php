<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Field;
use Syscover\Admin\Services\FieldService;
use Syscover\Core\Services\SQLService;

class FieldMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminField');
    }

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminFieldInput'))
            ],
        ];
    }
}

class AddFieldMutation extends FieldMutation
{
    protected $attributes = [
        'name'          => 'addField',
        'description'   => 'Add new field'
    ];

    public function resolve($root, $args)
    {
        return FieldService::create($args['object']);
    }
}

class UpdateFieldMutation extends FieldMutation
{
    protected $attributes = [
        'name'          => 'updateField',
        'description'   => 'Update field group'
    ];

    public function resolve($root, $args)
    {
        return FieldService::update($args['object']);
    }
}

class DeleteFieldMutation extends FieldMutation
{
    protected $attributes = [
        'name'          => 'deleteField',
        'description'   => 'Delete field group'
    ];

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ],
            'lang_id' => [
                'name' => 'lang_id',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::destroyRecord($args['id'], Field::class, $args['lang_id']);

        return $object;
    }
}
