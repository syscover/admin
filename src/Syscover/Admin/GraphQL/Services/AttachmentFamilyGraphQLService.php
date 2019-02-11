<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\AttachmentFamily;
use Syscover\Admin\Services\AttachmentFamilyService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class AttachmentFamilyGraphQLService extends CoreGraphQLService
{
    protected $model = AttachmentFamily::class;
    protected $service = AttachmentFamilyService::class;
}
