<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Admin\Services\ResourceService;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Resource;

class ResourceController extends CoreController
{
    protected $model = Resource::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response['status'] = "success";
        $response['data']   = ResourceService::create($request->all());

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   int     $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $response['status'] = "success";
        $response['data']   = ResourceService::update($request->all());

        return response()->json($response);
    }
}
