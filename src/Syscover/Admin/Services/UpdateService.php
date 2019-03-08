<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Package;

class UpdateService
{
    public static function check()
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

        return $versions;
    }

    public static function execute()
    {
        $response = self::check();

        // group versions
        $versionsGrouped = collect($response['data'])->groupBy('package_id');

        foreach ($versionsGrouped as $packageId => $versions)
        {
            $versions->sortBy('id');

            foreach ($versions as $version)
            {
                // ejecutar query
                info($version['query']);

                // ejecutar migrations

                // ejecutar composer
            }
        }

        return self::check();
    }
}
