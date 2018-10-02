<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\User;
use Syscover\Admin\Services\UserService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class UserGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = User::class;
    protected $serviceClassName = UserService::class;
}