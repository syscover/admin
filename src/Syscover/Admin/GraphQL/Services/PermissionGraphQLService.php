<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Action;
use Syscover\Admin\Models\Permission;
use Syscover\Admin\Models\Resource;
use Syscover\Admin\Services\PermissionService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class PermissionGraphQLService extends CoreGraphQLService
{
    public function __construct(Permission $model, PermissionService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }

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

    public function addAllPermissions($root, array $args)
    {
        $permissions = [];
        $resources = Resource::all();
        $actions = Action::all();

        foreach ($resources as $resource) {
            foreach ($actions as $action) {
                $permissions[] = [
                    'profile_id'    => $args['profile_id'],
                    'resource_id'   => $resource->id,
                    'action_id'     => $action->id
                ];
            }
        }

        Permission::where('profile_id', $args['profile_id'])->delete();
        Permission::insert($permissions);

        return true;
    }
}
