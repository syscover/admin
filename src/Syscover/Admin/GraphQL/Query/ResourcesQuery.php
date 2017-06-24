<?php namespace Syscover\Admin\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Admin\Models\Resource;

class ResourcesQuery extends Query {

    protected $attributes = [
        'name' => 'users'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('AdminAction'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'package_id' => ['name' => 'package_id', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args)
    {
        if(isset($args['id']))
        {
            return Resource::where('id' , $args['id'])->get();
        }
        else if(isset($args['name']))
        {
            return Resource::where('name', $args['name'])->get();
        }
        else
        {
            return Resource::all();
        }
    }

}