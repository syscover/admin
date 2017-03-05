<?php namespace Syscover\Admin\Controllers;

use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Lang;

/**
 * Class LangController
 * @package Syscover\Pulsar\Controllers
 */

class LangController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $langs = Lang::builder()
            ->get();

        return response()->json($langs);
    }

    /**
     * Display the specified resource.
     *
     * @param   string    $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $lang = Lang::builder()->find($id);

        return response()->json($lang);
    }
}