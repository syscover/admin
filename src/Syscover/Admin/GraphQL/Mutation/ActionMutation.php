<?php namespace Syscover\Admin\GraphQL\Mutation;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Action;

class ActionMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminAction');
    }

    public function args()
    {
        return [
            'idOld'     => ['name' => 'idOld',  'type' => Type::string()],
            'id'        => ['name' => 'id',     'type' => Type::nonNull(Type::string())],
            'name'      => ['name' => 'name',   'type' => Type::string()]
        ];
    }
}

class AddActionMutation extends ActionMutation
{
    protected $attributes = [
        'name'          => 'addAction',
        'description'   => 'Add new action'
    ];

    public function resolve($root, $args)
    {
        return Action::create($args);
    }
}

class UpdateActionMutation extends ActionMutation
{
    protected $attributes = [
        'name' => 'updateAction',
        'description' => 'Update action'
    ];

    public function resolve($root, $args)
    {
        Action::where('id', $args['idOld'])
            ->update([
                'id' => $args['id'],
                'name' => $args['name']
            ]);
        
        return Action::find($args['id']);
    }
}

class DeleteActionMutation extends ActionMutation
{
    protected $attributes = [
        'name' => 'deleteAction',
        'description' => 'Delete action'
    ];

    public function resolve($root, $args)
    {
        //return Action::create($args);
    }
}
