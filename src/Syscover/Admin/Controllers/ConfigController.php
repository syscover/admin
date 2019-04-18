<?php namespace Syscover\Admin\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ConfigController extends BaseController
{
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
