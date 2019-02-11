<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\User;
use Syscover\Admin\Services\UserService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class UserGraphQLService extends CoreGraphQLService
{
    public function __construct(User $model, UserService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
