<?php namespace Syscover\Admin\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /**
     * Login user and create a Personal Access Token
     *
     * @param  [string]     email
     * @param  [string]     password
     * @param  [boolean]    remember_me
     * @return [string]     status
     * @return [string]     status_text
     * @return [string]     access_token
     * @return [string]     token_type
     * @return [string]     expires_at
     */
    public function login()
    {
        $credentials    = request(['user', 'password']);
        $guard          = request('guard');

        if (! Auth::guard($guard)->attempt($credentials))
        {
            return response()->json([
                'status'        => 401,
                'status_text'   => 'Unauthorized'
            ], 401);
        }

        $user           = Auth::guard($guard)->user();
        $tokenResult    = $user->createToken('Personal Access Token');
        $token          = $tokenResult->token;

        if (request('remember_me'))
        {
            $token->expires_at = Carbon::now()->addMonths(1);
        }

        $token->save();

        return response()->json([
            'status'        => 200,
            'status_text'   => 'Successfully authorization',
            'access_token'  => $tokenResult->accessToken,
            'user'          => $user,
            'token_type'    => 'Bearer',
            'expires_at'    => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString()
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string]     status
     * @return [string]     status_text
     */
    public function logout()
    {
        request()->user()->token()->revoke();

        return response()->json([
            'status'        => 200,
            'status_text'   => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [string]     status
     * @return [string]     status_text
     * @return [User]       data
     */
    public function user()
    {
        return response()->json([
            'status'        => 200,
            'statusText'    => 'ok',
            'data'          => request()->user()
        ]);
    }
}