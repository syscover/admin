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
        $langs = Lang::builder()->get();

        $response['data'] = $langs;

        return response()->json($response);
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

        $response['data'] = $lang;

        return response()->json($response);
    }
}