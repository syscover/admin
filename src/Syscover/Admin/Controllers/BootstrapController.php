<?php namespace Syscover\Admin\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Syscover\Admin\Models\Lang;
use Syscover\Admin\Models\Package;
use Syscover\Core\Traits\ApiResponse;

class BootstrapController extends BaseController
{
    use ApiResponse;

    /**
     * Get values to bootstrap frontend application,
     * this values will be available throughout the application lifecycle
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // TODO controlar fallos

        $langs = Lang::all();

        $response['base_lang']  = $langs->where('id', base_lang())->first();
        $response['langs']      = $langs->where('active', true)->values();  // create a new collection with the keys reset to consecutive integers with values method
        $response['packages']   = Package::all();

        return $this->successResponse($response);
    }
}
