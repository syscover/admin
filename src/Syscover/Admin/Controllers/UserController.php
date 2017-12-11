<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Syscover\Admin\Services\UserService;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\User;

class UserController extends CoreController
{
    protected $model = User::class;

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $object = UserService::create($request->all());

            $response['status'] = "success";
            $response['data']   = $object;

            return response()->json($response);
        }
        catch (\Exception $e)
        {
            $response['status'] = "error";
            $response['message'] = $e->getMessage();

            return response()->json($response, 500);
        }
    }

    /**
     * Update the specified user in storage.
     *
     * @param   \Illuminate\Http\Request  $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try
        {
            $object = UserService::update($request->all());

            $response['status'] = "success";
            $response['data']   = $object;

            return response()->json($response);
        }
        catch (\Exception $e)
        {
            $response['status']     = "error";
            $response['message']    = $e->getMessage();

            return response()->json($response, 500);
        }
    }
}
