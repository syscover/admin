<?php namespace Syscover\Admin\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Syscover\Admin\Models\Package;

class UpdateService
{
    public static function check(string $panelVersion)
    {
        $packages = Package::where('active', true)->get();

        // check local versions
        foreach ($packages as $package)
        {
            if (! $package->version)
            {
                $package->version = package_version($package->root)['version'] ?? null;
                $package->save();
            }
        }

        // call to api update
        $versions = VersionService::check($packages, $panelVersion);

        // transform string to array
        $versions = json_decode($versions, true);

        return $versions;
    }

    public static function execute(string $panelVersion)
    {
        $response = self::check($panelVersion);

        // group versions
        $versionsGrouped = collect($response['data'])->groupBy('package_id');

        foreach ($versionsGrouped as $packageId => $versions)
        {
            $versions->sortBy('id');

            foreach ($versions as $version)
            {
                $localVersion = package_version($version['package']['root']);

                // execute composer
                if ($version['composer'])
                {
                    $process = new Process([config('pulsar-admin.composer_bin'), 'require', '--working-dir=' . base_path(), 'syscover/pulsar-admin'], null, ['COMPOSER_HOME' => storage_path() . '/composer']);
                    $process->setTimeout(null);
                    $process->run();

                    if (!$process->isSuccessful()) {
                        throw new ProcessFailedException($process);
                    }
                }

                // execute publish
                if ($version['publish'])
                {
                    Artisan::call('vendor:publish', ['provider' => $localVersion['provider'], 'force' => '']);
                }

                // execute migration
                if (! empty($version['migration']))
                {
                    Artisan::call('migrate', ['path' => $localVersion['migration_path']]);
                }

                // execute query
                if (! empty($version['query']))
                {
                    DB::select(DB::raw($version['query']));
                }
            }
        }

        return self::check();
    }
}
