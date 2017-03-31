<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Package;

class PackageController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $packages = Package::builder()->get();

        $response['data'] = $packages;

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
        $package = Package::builder()
            ->find($id);

        $response['data'] = $package;

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
