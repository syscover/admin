<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Permission;
use Syscover\Admin\Services\PermissionService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class PermissionGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = Permission::class;
    protected $serviceClassName = PermissionService::class;
}
