<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Services\UpdateService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class UpdateGraphQLService extends CoreGraphQLService
{
    public function check($root, array $args)
    {
        $versions = UpdateService::check();

        return $versions['data'];
    }

    public function execute($root, array $args)
    {
        $versions = UpdateService::execute();

        return $versions['data'];
    }
}
