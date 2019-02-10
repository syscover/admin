<?php namespace Syscover\Admin\Controllers;

use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Services\ActionService;
use Syscover\Admin\Models\Action;

class ActionController extends CoreController
{
    protected $model = Action::class;
    protected $service = ActionService::class;
}
