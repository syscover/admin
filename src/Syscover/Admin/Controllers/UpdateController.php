<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Admin\Services\UpdateService;
use Syscover\Core\Controllers\CoreController;

class UpdateController extends CoreController
{
    public function check(Request $request)
    {
        $versions = UpdateService::check();

        return $this->successResponse($versions['data']);
    }

    public function execute(Request $request)
    {
        $versions = UpdateService::execute();

        return $this->successResponse($versions['data']);
    }
}
