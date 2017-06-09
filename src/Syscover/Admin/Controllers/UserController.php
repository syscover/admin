<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            $object = User::create([
                'name'          => $request->input('name'),
                'surname'       => $request->input('surname'),
                'email'         => $request->input('email'),
                'lang_id'       => $request->input('lang_id'),
                'profile_id'    => $request->input('profile_id'),
                'access'        => $request->input('access'),
                'user'          => $request->input('user'),
                'password'      => Hash::make($request->input('password'))
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
     * Update the specified user in storage.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   int     $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try
        {
            User::where('id', $id)->update([
                'name'          => $request->input('name'),
                'surname'       => $request->input('surname'),
                'email'         => $request->input('email'),
                'lang_id'       => $request->input('lang_id'),
                'profile_id'    => $request->input('profile_id'),
                'access'        => $request->input('access'),
                'user'          => $request->input('user'),
                'password'      => Hash::make($request->input('password'))
            ]);
        }
        catch (\Exception $e)
        {
            $response['status']     = "error";
            $response['message']    = $e->getMessage();

            return response()->json($response, 500);
        }

        $object = User::find($request->input('id'));

        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }
}
