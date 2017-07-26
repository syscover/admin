<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Illuminate\Support\Facades\Hash;
use Syscover\Admin\Models\User;
use Syscover\Core\Services\SQLService;

class UserMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminUser');
    }

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminUserInput'))
            ],
        ];
    }
}

class AddUserMutation extends UserMutation
{
    protected $attributes = [
        'name'          => 'addUser',
        'description'   => 'Add new package'
    ];

    public function resolve($root, $args)
    {
        return User::create($args['object']);
    }
}

class UpdateUserMutation extends UserMutation
{
    protected $attributes = [
        'name' => 'updateUser',
        'description' => 'Update package'
    ];

    public function resolve($root, $args)
    {
        // create password
        $args['object']['password'] = Hash::make($args['object']['password']);

        User::where('id', $args['object']['id'])
            ->update($args['object']);

        return User::find($args['object']['id']);
    }
}

class DeleteUserMutation extends UserMutation
{
    protected $attributes = [
        'name' => 'deleteUser',
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
        $object = SQLService::destroyRecord($args['id'], User::class);

        return $object;
    }
}
