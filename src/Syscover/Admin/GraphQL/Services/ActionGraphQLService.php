<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Services\ActionService;
use Syscover\Admin\Models\Action;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class ActionGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = Action::class;
    protected $serviceClassName = ActionService::class;
}