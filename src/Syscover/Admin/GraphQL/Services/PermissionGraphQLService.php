<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Permission;
use Syscover\Admin\Services\PermissionService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class PermissionGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = Permission::class;
    protected $serviceClassName = PermissionService::class;

    public function update($root, array $args)
    {
        Permission::where('profile_id', $args['profile_id'])
            ->where('resource_id', $args['resource_id'])
            ->delete();

        $permissions = [];

        foreach ($args['actions'] as $action)
        {
            $permissions[] = [
                'profile_id'    => $args['profile_id'],
                'resource_id'   => $args['resource_id'],
                'action_id'     => $action,
            ];
        }

        if (count($permissions) > 0)
        {
            Permission::insert($permissions);
        }

        return true;
    }
}
