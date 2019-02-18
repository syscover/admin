<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Package;
use Syscover\Admin\Services\VersionService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class UpdateGraphQLService extends CoreGraphQLService
{
    public function check($root, array $args)
    {
        $packages = Package::where('active', true)->get();
info('hola mundo');
        // call to api update
        VersionService::check($packages);

        return true;
    }
}
