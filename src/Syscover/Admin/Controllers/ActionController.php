<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Action;

class ActionController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $actions = Action::builder()->get();

        $response['status'] = "success";
        $response['data']   = $actions;

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
        $action = Action::create([
            'id'    => $request->input('id'),
            'name'  => $request->input('name')
        ]);

        $response['status'] = "success";
        $response['data']   = $action;

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param   string  $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $action = Action::builder()
            ->find($id);

        $response['status'] = "success";
        $response['data'] = $action;

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

    /**
     * Remove the specified resource from storage.
     *
     * @param   string  $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $action = Action::builder()
            ->find($id);

        $action->delete();

        $response['status'] = "success";
        $response['data']   = $action;

        return response()->json($response);
    }
}
