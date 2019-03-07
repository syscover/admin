<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Package;
use Syscover\Admin\Services\VersionService;

class UpdateController extends CoreController
{
    public function check(Request $request)
    {
        $packages = Package::where('active', true)->get();

        // check local versions
        foreach ($packages as $package)
        {
            if (! $package->version)
            {
                $package->version = package_version($package);
                $package->save();
            }
        }

        // call to api update
        $versions = VersionService::check($packages);

        // transform string to array
        $versions = json_decode($versions, true);

        return $this->successResponse($versions['data']);
    }
}
