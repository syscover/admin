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
        if ($args['checked'])
        {
            $this->service->create($args);
        }
        else
        {
            Permission::where('profile_id', $args['profile_id'])
                ->where('resource_id', $args['resource_id'])
                ->where('action_id', $args['action_id'])
                ->delete();
        }

        return true;
    }
}
