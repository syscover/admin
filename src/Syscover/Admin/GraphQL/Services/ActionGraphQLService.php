<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Services\ActionService;
use Syscover\Admin\Models\Action;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class ActionGraphQLService extends CoreGraphQLService
{
    public function __construct(Action $model, ActionService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
