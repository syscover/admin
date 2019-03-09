<?php namespace Syscover\Admin\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class VersionService
{
    public static function check(Collection $packages, string $panelVersion)
    {
        $baseUri    = env('APP_ENV') === 'production' ? 'https://updates.syscover.net' : 'http://api.pulsar.local';
        $versions   = [];
        $uri        = '/api/v1/update/version/check';

        foreach ($packages as $package)
        {
            $versions[] = [
                'package_id'    => $package->id,
                'version'       => $package->version
            ];
        }

        $client = new Client([
            'base_uri' => $baseUri
        ]);

        $response = $client->request('POST', $uri, [
            'form_params' => [
                'variables'     => $versions,
                'panel_version' => $panelVersion
            ]
        ]);

        return $response->getBody()->getContents();
    }
}
