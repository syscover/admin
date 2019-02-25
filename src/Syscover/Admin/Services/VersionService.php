<?php namespace Syscover\Admin\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class VersionService
{
    public static function check(Collection $packages)
    {
        $baseUri    = env('APP_ENV') === 'production' ? 'https://updates.syscover.net' : 'http://api.pulsar.local';
        $versions   = [];
        $uri        = '/api/v1/update/version/check';
        foreach ($packages as $package)
        {
            $path = env('APP_ENV') === 'production' ?
                'vendor/syscover/pulsar-' . $package->root . '/src/version.php' : 'workbench/syscover/pulsar-' . $package->root . '/src/version.php';

            if (file_exists(base_path($path)))
            {
                $version = require base_path($path);
                $versions[] = [
                    'package_id'    => $package->id,
                    'version'       => $version['version']
                ];
            }
        }

        $client = new Client([
            'base_uri' => $baseUri
        ]);

        $response = $client->request('POST', $uri, [
            'form_params' => [
                'variables' => $versions
            ]
        ]);

        return $response->getBody()->getContents();
    }
}
