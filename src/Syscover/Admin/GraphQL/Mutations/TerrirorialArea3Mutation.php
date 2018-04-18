<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\TerritorialArea3;
use Syscover\Admin\Services\TerritorialArea3Service;
use Syscover\Core\Services\SQLService;

class TerritorialArea3Mutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminTerritorialArea3');
    }
}

class AddTerritorialArea3Mutation extends TerritorialArea3Mutation
{
    protected $attributes = [
        'name' => 'addTerritorialArea3',
        'description' => 'Add new action'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminTerritorialArea3Input'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return TerritorialArea3Service::create($args['object']);
    }
}

class UpdateTerritorialArea3Mutation extends TerritorialArea3Mutation
{
    protected $attributes = [
        'name' => 'updateTerritorialArea3',
        'description' => 'Update action'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminTerritorialArea3Input'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return TerritorialArea3Service::update($args['object']);
    }
}

class DeleteTerritorialArea3Mutation extends TerritorialArea3Mutation
{
    protected $attributes = [
        'name' => 'deleteTerritorialArea3',
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
        $object = SQLService::destroyRecord($args['id'], TerritorialArea3::class);

        return $object;
    }
}
