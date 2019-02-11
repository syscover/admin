<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Resource;
use Syscover\Admin\Services\ResourceService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class ResourceGraphQLService extends CoreGraphQLService
{
    public function __construct(Resource $model, ResourceService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
