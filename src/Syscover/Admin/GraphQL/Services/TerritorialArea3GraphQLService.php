<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\TerritorialArea3;
use Syscover\Admin\Services\TerritorialArea3Service;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class TerritorialArea3GraphQLService extends CoreGraphQLService
{
    public function __construct(TerritorialArea3 $model, TerritorialArea3Service $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
