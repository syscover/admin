<?php namespace Syscover\Admin\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Syscover\Admin\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthenticationController extends BaseController
{
    public function login(Request $request)
    {
        $credentials = $request->only('user', 'password');

        try
        {
            // try to get user from database
            $user = User::where(['user' => $credentials['user']])->first();

            if($user)
            {
                if(
                    // instance token and encrypt user params
                    ! $token = JWTAuth::fromUser($user, $user->toArray())
                    // if token is created go to last return
                )
                {
                    $response['status'] = "error";
                    $response['message'] = "Invalid credentials";

                    return response()->json($response, 401);
                }
            }
            else
            {
                $response['status'] = "error";
                $response['message'] = "Invalid credentials";

                return response()->json($response, 401);
            }
        }
        catch (JWTException $e)
        {
            // JWT couldn't create token
            $response['status'] = "error";
            $response['message'] = $e->getMessage();

            return response()->json($response, 500);
        }

        // token created
        $response['status'] = "success";
        $response['token']   = $token;

        return response()->json($response);
    }
}
