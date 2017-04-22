<?php namespace Syscover\Admin\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Syscover\Admin\Models\Lang;

class ConfigController extends BaseController
{
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

    public function values($env)
    {
        $response['status']     = "success";
        $response['base_lang']  = Lang::getBaseLang();

        return response()->json($response);
    }
}
