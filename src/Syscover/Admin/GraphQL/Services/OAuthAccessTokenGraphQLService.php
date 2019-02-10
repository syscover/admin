<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\OAuthAccessToken;
use Syscover\Admin\Services\OAuthAccessTokenService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class OAuthAccessTokenGraphQLService extends CoreGraphQLService
{
    protected $model = OAuthAccessToken::class;
    protected $serviceClassName = OAuthAccessTokenService::class;
}
