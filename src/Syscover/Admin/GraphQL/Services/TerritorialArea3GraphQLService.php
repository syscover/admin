<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\TerritorialArea3;
use Syscover\Admin\Services\TerritorialArea3Service;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class TerritorialArea3GraphQLService extends CoreGraphQLService
{
    protected $modelClassName = TerritorialArea3::class;
    protected $serviceClassName = TerritorialArea3Service::class;
}