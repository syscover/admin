<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\TerritorialArea2;
use Syscover\Admin\Services\TerritorialArea2Service;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class TerritorialArea2GraphQLService extends CoreGraphQLService
{
    protected $model = TerritorialArea2::class;
    protected $service = TerritorialArea2Service::class;
}
