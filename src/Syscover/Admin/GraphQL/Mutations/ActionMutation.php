<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Action;
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
        'name'          => 'addAction',
        'description'   => 'Add new action'
    ];

    public function args()
    {
        return [
            'action' => [
                'name' => 'action',
                'type' => Type::nonNull(GraphQL::type('AdminActionInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return Action::create($args['action']);
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
            'action' => [
                'name' => 'action',
                'type' => Type::nonNull(GraphQL::type('AdminActionInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        Action::where('id', $args['idOld'])
            ->update($args['action']);

        return Action::find($args['action']['id']);
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
        $object = SQLService::destroyRecord($args, Action::class);

        return $object;
    }
}
