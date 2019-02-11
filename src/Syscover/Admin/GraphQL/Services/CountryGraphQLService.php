<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Country;
use Syscover\Admin\Services\CountryService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class CountryGraphQLService extends CoreGraphQLService
{
    protected $model = Country::class;
    protected $service = CountryService::class;
}
