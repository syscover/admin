<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\Profile;
use Syscover\Admin\Services\ProfileService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class ProfileGraphQLService extends CoreGraphQLService
{
    protected $model = Profile::class;
    protected $service = ProfileService::class;
}