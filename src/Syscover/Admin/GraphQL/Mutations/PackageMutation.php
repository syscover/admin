<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Package;
use Syscover\Admin\Services\PackageService;
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
            'object' => [
                'name' => 'object',
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
        return PackageService::create($args['object']);
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
        Package::where('id', $args['object']['id'])
            ->update($args['object']);

        return Package::find($args['object']['id']);

        PackageService::update($args['object']);
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
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::destroyRecord($args['id'], Package::class);

        return $object;
    }
}
