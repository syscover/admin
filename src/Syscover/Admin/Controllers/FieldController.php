<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Field;

class FieldController extends CoreController
{
    protected $model = Field::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $object = Field::create([
                'name'          => $request->input('name'),
                'resource_id'   => $request->input('resource_id')
            ]);
        }
        catch (\Exception $e)
        {
            $response['status'] = "error";
            $response['message'] = $e->getMessage();

            return response()->json($response, 500);
        }

        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \Illuminate\Http\Request $request
     * @param   int $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try
        {
            Field::where('id', $id)->update([
                'name'          => $request->input('name'),
                'resource_id'   => $request->input('resource_id')
            ]);
        }
        catch (\Exception $e)
        {
            $response['status'] = "error";
            $response['message'] = $e->getMessage();

            return response()->json($response, 500);
        }

        $object = FieldGroup::find($request->input('id'));

        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }
}
