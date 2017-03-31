<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Profile;

class ProfileController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $profiles = Profile::builder()->get();

        $response['data'] = $profiles;

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
     * @param   int     $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $profile = Profile::builder()->find($id);

        $response['data'] = $profile;

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
