<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Services\ActionService;
use Syscover\Admin\Models\Action;

class ActionController extends CoreController
{
    protected $model = Action::class;
    protected $service = ActionService::class;


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
