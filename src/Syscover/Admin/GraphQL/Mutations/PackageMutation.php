<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Package;
use Syscover\Core\Services\SQLService;

class PackageMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminPackage');
    }

    public function args()
    {
        return [
            'package' => [
                'name' => 'package',
                'type' => Type::nonNull(GraphQL::type('AdminPackageInput'))
            ],
        ];
    }
}

class AddPackageMutation extends PackageMutation
{
    protected $attributes = [
        'name'          => 'addPackage',
        'description'   => 'Add new package'
    ];

    public function resolve($root, $args)
    {
        return Package::create($args['package']);
    }
}

class UpdatePackageMutation extends PackageMutation
{
    protected $attributes = [
        'name' => 'updatePackage',
        'description' => 'Update package'
    ];

    public function resolve($root, $args)
    {
        Package::where('id', $args['package']['id'])
            ->update($args['package']);

        return Package::find($args['package']['id']);
    }
}

class DeletePackageMutation extends PackageMutation
{
    protected $attributes = [
        'name' => 'deletePackage',
        'description' => 'Delete package'
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
        $object = SQLService::destroyRecord($args['id'], Package::class);

        return $object;
    }
}
