<?php namespace Syscover\Admin\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Admin\Models\Action;

class ActionsQuery extends Query {

    protected $attributes = [
        'name' => 'users'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('Action'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()]
        ];
    }

    public function resolve($root, $args)
    {
        if(isset($args['id']))
        {
            return Action::where('id' , $args['id'])->get();
        }
        else if(isset($args['name']))
        {
            return Action::where('name', $args['name'])->get();
        }
        else
        {
            return Action::all();
        }
    }

}