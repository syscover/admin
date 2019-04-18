<?php namespace Syscover\Admin\Controllers;

use Syscover\Admin\Services\CountryService;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Country;

class CountryController extends CoreController
{
    public function __construct(Country $model, CountryService $service)
    {
        $this->model = $model;
        $this->service = $service;
    }
}
