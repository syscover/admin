<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Package;
use Syscover\Admin\Services\PackageService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class PackageGraphQLService extends CoreGraphQLService
{
    public function __construct(Package $model, PackageService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
