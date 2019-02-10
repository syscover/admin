<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\TerritorialArea1;
use Syscover\Admin\Services\TerritorialArea1Service;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class TerritorialArea1GraphQLService extends CoreGraphQLService
{
    protected $model = TerritorialArea1::class;
    protected $serviceClassName = TerritorialArea1Service::class;
}
