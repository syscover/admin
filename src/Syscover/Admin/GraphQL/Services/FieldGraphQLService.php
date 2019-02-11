<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Field;
use Syscover\Admin\Services\FieldService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class FieldGraphQLService extends CoreGraphQLService
{
    public function __construct(Field $model, FieldService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
