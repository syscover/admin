<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\FieldGroup;
use Syscover\Core\Services\SQLService;

class FieldGroupMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminFieldGroup');
    }

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminFieldGroupInput'))
            ],
        ];
    }
}

class AddFieldGroupMutation extends FieldGroupMutation
{
    protected $attributes = [
        'name'          => 'addFieldGroup',
        'description'   => 'Add new field group'
    ];

    public function resolve($root, $args)
    {
        return FieldGroup::create($args['object']);
    }
}

class UpdateFieldGroupMutation extends FieldGroupMutation
{
    protected $attributes = [
        'name' => 'updateFieldGroup',
        'description' => 'Update field group'
    ];

    public function resolve($root, $args)
    {
        FieldGroup::where('id', $args['object']['id'])
            ->update($args['object']);

        return FieldGroup::find($args['object']['id']);
    }
}

class DeleteFieldGroupMutation extends FieldGroupMutation
{
    protected $attributes = [
        'name' => 'deleteFieldGroup',
        'description' => 'Delete field group'
    ];

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::deleteRecord($args['id'], FieldGroup::class);

        return $object;
    }
}
