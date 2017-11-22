<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Resource;
use Syscover\Admin\Services\ResourceService;
use Syscover\Core\Services\SQLService;

class ResourceMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminResource');
    }
}

class AddResourceMutation extends ResourceMutation
{
    protected $attributes = [
        'name'          => 'addResource',
        'description'   => 'Add new resource'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminResourceInput'))
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return ResourceService::create($args['object']);
    }
}

class UpdateResourceMutation extends ResourceMutation
{
    protected $attributes = [
        'name' => 'updateResource',
        'description' => 'Update resource'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminResourceInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return ResourceService::update($args['object']);
    }
}

class DeleteResourceMutation extends ResourceMutation
{
    protected $attributes = [
        'name' => 'deleteResource',
        'description' => 'Delete resource'
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
        $object = SQLService::destroyRecord($args['id'], Resource::class);

        return $object;
    }
}
