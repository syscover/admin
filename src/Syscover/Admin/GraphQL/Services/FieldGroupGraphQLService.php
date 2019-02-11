<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\FieldGroup;
use Syscover\Admin\Services\FieldGroupService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class FieldGroupGraphQLService extends CoreGraphQLService
{
    public function __construct(FieldGroup $model, FieldGroupService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
