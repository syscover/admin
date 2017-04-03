<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Action;

class ActionController extends CoreController
{
    protected $model = Action::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $action = Action::create([
            'id'    => $request->input('id'),
            'name'  => $request->input('name')
        ]);

        $response['status'] = "success";
        $response['data']   = $action;

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
        Action::where('id', $id)->update([
            'id'    => $request->input('id'),
            'name'  => $request->input('name')
        ]);

        $action = Action::find($request->input('id'));

        $response['status'] = "success";
        $response['data']   = $action;

        return response()->json($response);
    }
}
