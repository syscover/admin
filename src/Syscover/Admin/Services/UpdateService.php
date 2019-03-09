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
                $package->version = '1.0.0';
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

        // get all packages to update
        $packages = Package::whereIn('id', $versionsGrouped->keys())->get();

        // get packages to execute with composer
        $packagesComposerName = [];
        foreach ($versionsGrouped as $packageId => $versions)
        {
            $versions->sortBy('id');
            foreach ($versions as $version)
            {
                if ($version['composer'])
                {
                    // get package name to update with composer
                    $packagesComposerName[] = package_version($version['package']['root'])['package'];
                    break;
                }
            }
        }

        info('Execute composer update for this packages: ' . implode(' ', $packagesComposerName));

        // if there are any packages execute composer update
        if (count($packagesComposerName) > 0)
        {
            $process = new Process([config('pulsar-admin.composer_bin'), 'update', '--working-dir=' . base_path(), implode(' ', $packagesComposerName)], null, ['COMPOSER_HOME' => storage_path() . '/composer']);
            $process->setTimeout(null);
            $process->run();

            if (!$process->isSuccessful())
            {
                throw new ProcessFailedException($process);
            }
            info('Composer update is over');
        }

        // execute the rest of processes
        foreach ($versionsGrouped as $packageId => $versions)
        {
            $versions->sortBy('id');
            $lastVersion = null;
            foreach ($versions as $version)
            {
                $localVersion = package_version($version['package']['root']);

                // execute publish
                if ($version['publish'])
                {
                    info('Execute vendor publish command: vendor:publish --provider="' . $localVersion['provider'] . '" --force');
                    Artisan::call('vendor:publish --provider="' . $localVersion['provider'] . '" --force');
                }

                // execute migration
                if (! empty($version['migration']))
                {
                    info('Execute migrate command: migrate --path=' . $localVersion['migration_path']);
                    Artisan::call('migrate --path=' . $localVersion['migration_path']);
                }

                // execute query
                if (! empty($version['query']))
                {
                    info('Execute query from version: ' . $version['version']);
                    DB::select(DB::raw($version['query']));
                }

                $lastVersion = $version;
            }

            // update version number
            $package = $packages->firstWhere('id', $packageId);
            $package->version = $lastVersion['version'];
            $package->save();
        }

        return self::check($panelVersion);
    }
}
