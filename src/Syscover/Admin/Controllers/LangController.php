<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Services\LangService;
use Syscover\Admin\Models\Lang;

/**
 * Class LangController
 * @package Syscover\Admin\Controllers
 */

class LangController extends CoreController
{
    protected $model = Lang::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response['status'] = "success";
        $response['data']   = LangService::create($request->all());

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   $ix
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $ix)
    {
        $response['status'] = "success";
        $response['data']   = LangService::update($request->all(), $ix);

        return response()->json($response);
    }
}
