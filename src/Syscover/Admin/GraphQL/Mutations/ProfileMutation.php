<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Profile;
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
        return Profile::create($args['object']);
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
        Profile::where('id', $args['object']['id'])
            ->update($args['object']);

        return Profile::find($args['object']['id']);
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
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::destroyRecord($args['id'], Profile::class);

        return $object;
    }
}
