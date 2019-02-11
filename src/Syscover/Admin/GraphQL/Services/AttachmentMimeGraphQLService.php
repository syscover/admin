<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\AttachmentMime;
use Syscover\Admin\Services\AttachmentMimeService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class AttachmentMimeGraphQLService extends CoreGraphQLService
{
    public function __construct(AttachmentMime $model, AttachmentMimeService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
