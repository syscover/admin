<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Action;
use Syscover\Admin\Services\ActionService;
use Syscover\Core\Services\SQLService;

class ActionMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminAction');
    }
}

class AddActionMutation extends ActionMutation
{
    protected $attributes = [
        'name' => 'addAction',
        'description' => 'Add new action'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminActionInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return ActionService::create($args['object']);
    }
}

class UpdateActionMutation extends ActionMutation
{
    protected $attributes = [
        'name' => 'updateAction',
        'description' => 'Update action'
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
                'type' => Type::nonNull(GraphQL::type('AdminActionInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return ActionService::update($args['object'], $args['idOld']);
    }
}

class DeleteActionMutation extends ActionMutation
{
    protected $attributes = [
        'name' => 'deleteAction',
        'description' => 'Delete action'
    ];

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::destroyRecord($args['id'], Action::class);

        return $object;
    }
}
