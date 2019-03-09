<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Services\UpdateService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class UpdateGraphQLService extends CoreGraphQLService
{
    public function check($root, array $args)
    {
        $versions = UpdateService::check($args['panel_version']);

        return $versions['data'];
    }

    public function execute($root, array $args)
    {
        $versions = UpdateService::execute($args['panel_version']);

        return $versions['data'];
    }
}
