<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\OAuthAccessToken;
use Syscover\Admin\Services\OAuthAccessTokenService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class OAuthAccessTokenGraphQLService extends CoreGraphQLService
{
    public function __construct(OAuthAccessToken $model, OAuthAccessTokenService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
