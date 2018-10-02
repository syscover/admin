<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\OAuthClient;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class OAuthGraphQLService extends CoreGraphQLService
{
    protected $model = OAuthClient::class;
    // protected $service = OAuthClientService::class;

    public function resolveForUser($root, array $args)
    {
        return OAuthClient::all();
    }
}