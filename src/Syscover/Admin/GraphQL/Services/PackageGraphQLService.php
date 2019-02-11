<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Package;
use Syscover\Admin\Services\PackageService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class PackageGraphQLService extends CoreGraphQLService
{
    protected $model = Package::class;
    protected $service = PackageService::class;
}
