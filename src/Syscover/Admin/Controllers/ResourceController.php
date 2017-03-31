<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Resource;

class ResourceController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $resources = Resource::builder()->get();

        $response['data'] = $resources;

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param   string  $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $resource = Resource::builder()
            ->find($id);

        $response['data'] = $resource;

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   int     $id
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id, $lang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   int     $id
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function destroy($id, $lang = null)
    {
        //
    }
}
