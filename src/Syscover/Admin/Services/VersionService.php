<?php namespace Syscover\Admin\Services;

use GuzzleHttp\Client;

class VersionService
{
    public static function check($package)
    {
        if (env('APP_ENV') === 'production') {
            $path       = 'vendor/syscover/pulsar-' . $package . '/src/version.php';
            $baseUri    = 'https://updates.syscover.net';
            $uri        = '/update/version/check';
        }
        else {
            $path       = 'workbench/syscover/pulsar-' . $package . '/src/version.php';
            $baseUri    = 'http://api.pulsar.local';
            $uri        = '/update/version/check';
        }

        if (file_exists(base_path($path))) $version = require base_path($path);

        $client = new Client([
            'base_uri' => $baseUri
        ]);

        $client->request('GET', $uri, [
            'variables' => [
                ['package_id' => '', 'version' => '']
            ]
        ]);
    }
}
