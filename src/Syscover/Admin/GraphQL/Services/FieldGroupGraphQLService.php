<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\FieldGroup;
use Syscover\Admin\Services\FieldGroupService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class FieldGroupGraphQLService extends CoreGraphQLService
{
    protected $model = FieldGroup::class;
    protected $serviceClassName = FieldGroupService::class;
}
