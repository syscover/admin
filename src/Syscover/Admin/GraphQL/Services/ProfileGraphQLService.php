<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Profile;
use Syscover\Admin\Services\ProfileService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class ProfileGraphQLService extends CoreGraphQLService
{
    public function __construct(Profile $model, ProfileService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
