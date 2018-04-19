<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\TerritorialArea1;
use Syscover\Admin\Services\TerritorialArea1Service;
use Syscover\Core\Services\SQLService;

class TerritorialArea1Mutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminTerritorialArea1');
    }
}

class AddTerritorialArea1Mutation extends TerritorialArea1Mutation
{
    protected $attributes = [
        'name' => 'addTerritorialArea1',
        'description' => 'Add new territorial area 1'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminTerritorialArea1Input'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return TerritorialArea1Service::create($args['object']);
    }
}

class UpdateTerritorialArea1Mutation extends TerritorialArea1Mutation
{
    protected $attributes = [
        'name' => 'updateTerritorialArea1',
        'description' => 'Update territorial area 1'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminTerritorialArea1Input'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return TerritorialArea1Service::update($args['object']);
    }
}

class DeleteTerritorialArea1Mutation extends TerritorialArea1Mutation
{
    protected $attributes = [
        'name' => 'deleteTerritorialArea1',
        'description' => 'Delete territorial area 1'
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
        $object = SQLService::destroyRecord($args['id'], TerritorialArea1::class);

        return $object;
    }
}
