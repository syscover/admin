<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\OAuthClient;
use Syscover\Admin\Services\OAuthClientService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class OAuthClientGraphQLService extends CoreGraphQLService
{
    public function __construct(OAuthClient $model, OAuthClientService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
