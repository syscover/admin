<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Services\ActionService;
use Syscover\Admin\Models\Action;

class ActionController extends CoreController
{
    protected $model = Action::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        try
        {
            $object = ActionService::create($request->all());
        }
        catch (\Exception $e)
        {
            return response()->json([
                'status'        => 500,
                'statusText'    => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status'        => 200,
            'statusText'    => 'success',
            'data'          => $object
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \Illuminate\Http\Request    $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try
        {
            $object = ActionService::update($request->all());
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
