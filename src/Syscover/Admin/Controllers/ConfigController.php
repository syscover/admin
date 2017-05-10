<?php namespace Syscover\Admin\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Syscover\Admin\Models\Lang;

class ConfigController extends BaseController
{
    /**
     * Get environment application
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function env()
    {
        if(config('app.env') === 'production')
        {
            $env = 'production';
        }
        else
        {
            $env = 'development';
        }

        $response['env'] = $env;
        return response()->json($response);
    }

    /**
     * Get values to bootstrap frontend application,
     * this values will be available throughout the application lifecycle
     *
     * @param   string $env
     * @return  \Illuminate\Http\JsonResponse
     */
    public function bootstrap($env)
    {
        $response['status']     = "success";
        $response['base_lang']  = base_lang();
        $response['langs']      = Lang::where('active', true)->get();

        return response()->json($response);
    }

    /**
     * Get values from config files
     *
     * @param   Request $request
     * @return  \Illuminate\Http\JsonResponse
     */
    public function values(Request $request)
    {
        $response['status'] = "success";
        $response['data']   = config($request->input('key'));

        if($request->has('translate'))
        {
            // set lang
            App::setLocale($request->input('translate')['lang']);
            $property = $request->input('translate')['property'];

            // translate property indicated
            $response['data'] = array_map(function($object) use ($property) {
                $object->{$property} = trans($object->{$property});
                return $object;
            }, $response['data']);
        }

        return response()->json($response);
    }
}
