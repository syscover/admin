<?php namespace Syscover\Admin\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Syscover\Admin\Models\Lang;
use Syscover\Admin\Models\Package;

class ConfigController extends BaseController
{
    /**
     * Get values to bootstrap frontend application,
     * this values will be available throughout the application lifecycle
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function bootstrap()
    {
        $response['status']     = "success";
        $response['base_lang']  = base_lang();
        $response['langs']      = Lang::all();
        $response['packages']   = Package::all();

        return response()->json($response);
    }

    /**
     * Get values from anuy config files
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
