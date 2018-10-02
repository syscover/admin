<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\AttachmentMime;
use Syscover\Admin\Services\AttachmentMimeService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class AttachmentMimeGraphQLService extends CoreGraphQLService
{
    protected $modelClassName = AttachmentMime::class;
    protected $serviceClassName = AttachmentMimeService::class;
}