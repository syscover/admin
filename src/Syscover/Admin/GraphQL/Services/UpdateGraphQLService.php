<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Package;
use Syscover\Admin\Services\VersionService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class UpdateGraphQLService extends CoreGraphQLService
{
    public function check($root, array $args)
    {
        // call to api update
        $versions = VersionService::check(Package::where('active', true)->get());

        $versions = json_decode($versions, true);

        return $versions['data'];
    }
}
