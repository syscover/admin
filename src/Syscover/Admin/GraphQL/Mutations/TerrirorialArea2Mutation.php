<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\TerritorialArea2;
use Syscover\Admin\Services\TerritorialArea2Service;
use Syscover\Core\Services\SQLService;

class TerritorialArea2Mutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminTerritorialArea2');
    }
}

class AddTerritorialArea2Mutation extends TerritorialArea2Mutation
{
    protected $attributes = [
        'name' => 'addTerritorialArea2',
        'description' => 'Add new territorial area 2'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminTerritorialArea2Input'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return TerritorialArea2Service::create($args['object']);
    }
}

class UpdateTerritorialArea2Mutation extends TerritorialArea2Mutation
{
    protected $attributes = [
        'name' => 'updateTerritorialArea2',
        'description' => 'Update territorial area 2'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminTerritorialArea2Input'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return TerritorialArea2Service::update($args['object']);
    }
}

class DeleteTerritorialArea2Mutation extends TerritorialArea2Mutation
{
    protected $attributes = [
        'name' => 'deleteTerritorialArea2',
        'description' => 'Delete territorial area 2'
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
        $object = SQLService::destroyRecord($args['id'], TerritorialArea2::class);

        return $object;
    }
}
