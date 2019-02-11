<?php namespace Syscover\Admin\GraphQL\Services;

use Syscover\Admin\Models\AttachmentFamily;
use Syscover\Admin\Services\AttachmentFamilyService;
use Syscover\Core\GraphQL\Services\CoreGraphQLService;

class AttachmentFamilyGraphQLService extends CoreGraphQLService
{
    public function __construct(AttachmentFamily $model, AttachmentFamilyService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
