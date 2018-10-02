<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\AttachmentFamily;
use Syscover\Admin\Services\AttachmentFamilyService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class AttachmentFamilyGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = AttachmentFamily::class;
    protected $serviceClassName = AttachmentFamilyService::class;
}