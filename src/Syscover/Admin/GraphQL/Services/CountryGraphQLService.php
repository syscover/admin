<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Country;
use Syscover\Admin\Services\CountryService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class CountryGraphQLService extends CoreGraphQLService
{
    public function __construct(Country $model, CountryService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
