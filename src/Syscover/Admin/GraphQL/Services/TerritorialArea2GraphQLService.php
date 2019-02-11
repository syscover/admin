<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\TerritorialArea2;
use Syscover\Admin\Services\TerritorialArea2Service;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class TerritorialArea2GraphQLService extends CoreGraphQLService
{
    public function __construct(TerritorialArea2 $model, TerritorialArea2Service $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
