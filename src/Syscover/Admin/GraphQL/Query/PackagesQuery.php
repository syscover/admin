<?php namespace Syscover\Admin\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Admin\Models\Package;

class PackagesQuery extends Query {

    protected $attributes = [
        'name' => 'users',
        'description' => 'Query to get list elements.'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('AdminPackage'));
    }

    public function args()
    {
        return [
            'id' => ['name' => 'id', 'type' => Type::string()],
            'name' => ['name' => 'name', 'type' => Type::string()],
            'root' => ['name' => 'root', 'type' => Type::string()],
            'active' => ['name' => 'active', 'type' => Type::boolean()],
            'sort' => ['name' => 'sort', 'type' => Type::int()]
        ];
    }

    public function resolve($root, $args)
    {
        if(isset($args['id']))
        {
            return Package::where('id' , $args['id'])->get();
        }
        else if(isset($args['email']))
        {
            return Package::where('name', $args['email'])->get();
        }
        else
        {
            return Package::all();
        }
    }

}