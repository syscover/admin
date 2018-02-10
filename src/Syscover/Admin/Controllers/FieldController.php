<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Admin\Services\FieldService;
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
            $object = FieldService::create($request->all());
        }
        catch (\Exception $e)
        {
            $response['status']     = "error";
            $response['message']    = $e->getMessage();

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
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try
        {
            $object = FieldService::update($request->all());
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
}
