<?php namespace Syscover\Admin\Controllers;

use Syscover\Admin\Services\PackageService;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Package;

class PackageController extends CoreController
{
    public function __construct(Package $model, PackageService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
