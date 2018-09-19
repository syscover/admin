<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Services\ActionService;
use Syscover\Admin\Models\Action;
use Syscover\Core\GraphQL\Services\CoreGraphQL;

class ActionGraphQL extends CoreGraphQL
{
    protected $model = Action::class;
    protected $service = ActionService::class;
}