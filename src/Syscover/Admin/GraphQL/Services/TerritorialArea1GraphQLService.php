<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\TerritorialArea1;
use Syscover\Admin\Services\TerritorialArea1Service;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class TerritorialArea1GraphQLService extends CoreGraphQLService
{
    public function __construct(TerritorialArea1 $model, TerritorialArea1Service $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
