<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Profile;

class ProfileController extends CoreController
{
    protected $model = Profile::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $profile = Profile::create([
            'name'  => $request->input('name')
        ]);

        $response['status'] = "success";
        $response['data']   = $profile;

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
        Profile::where('id', $id)->update([
            'name'  => $request->input('name')
        ]);

        $profile = Profile::find($request->input('id'));

        $response['status'] = "success";
        $response['data']   = $profile;

        return response()->json($response);
    }
}
