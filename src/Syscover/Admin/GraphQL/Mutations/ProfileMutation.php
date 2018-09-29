<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Profile;
use Syscover\Admin\Services\ProfileService;
use Syscover\Core\Services\SQLService;

class ProfileMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminProfile');
    }

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminProfileInput'))
            ],
        ];
    }
}

class AddProfileMutation extends ProfileMutation
{
    protected $attributes = [
        'name'          => 'addProfile',
        'description'   => 'Add new profile'
    ];

    public function resolve($root, $args)
    {
        return ProfileService::create($args['object']);
    }
}

class UpdateProfileMutation extends ProfileMutation
{
    protected $attributes = [
        'name' => 'updateProfile',
        'description' => 'Update profile'
    ];

    public function resolve($root, $args)
    {
        return ProfileService::update($args['object']);
    }
}

class DeleteProfileMutation extends ProfileMutation
{
    protected $attributes = [
        'name' => 'deleteProfile',
        'description' => 'Delete profile'
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
        $object = SQLService::deleteRecord($args['id'], Profile::class);

        return $object;
    }
}
