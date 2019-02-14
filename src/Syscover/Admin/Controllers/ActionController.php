<?php namespace Syscover\Admin\Controllers;

use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Services\ActionService;
use Syscover\Admin\Models\Action;

class ActionController extends CoreController
{
    public function __construct(Action $model, ActionService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
