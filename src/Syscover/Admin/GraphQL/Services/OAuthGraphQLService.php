<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\OAuthClient;
use Syscover\Admin\Services\OAuthClientService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class OAuthGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = OAuthClient::class;
    protected $serviceClassName = OAuthClientService::class;

    public function resolveForUser($root, array $args)
    {
        return $this->model->all();
    }
}