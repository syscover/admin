<?php namespace Syscover\Admin\Controllers;

use Syscover\Admin\Models\AttachmentFamily;
use Syscover\Admin\Services\AttachmentFamilyService;
use Syscover\Core\Controllers\CoreController;

class AttachmentFamilyController extends CoreController
{
    public function __construct(AttachmentFamily $model, AttachmentFamilyService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
