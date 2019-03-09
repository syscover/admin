<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Admin\Services\UpdateService;
use Syscover\Core\Controllers\CoreController;

class UpdateController extends CoreController
{
    public function check(Request $request)
    {
        $versions = UpdateService::check($request->input('panel_version'));

        return $this->successResponse($versions['data']);
    }

    public function execute(Request $request)
    {
        $versions = UpdateService::execute($request->input('panel_version'));

        return $this->successResponse($versions['data']);
    }
}
