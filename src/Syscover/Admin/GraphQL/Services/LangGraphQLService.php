<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Lang;
use Syscover\Admin\Services\LangService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class LangGraphQLService extends CoreGraphQLService
{
    protected $model = Lang::class;
    protected $serviceClassName = LangService::class;
}
