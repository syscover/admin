<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Lang;

/**
 * Class LangController
 * @package Syscover\Pulsar\Controllers
 */

class LangController extends CoreController
{
    protected $model = Lang::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $object = Lang::create([
                'id'        => $request->input('id'),
                'name'      => $request->input('name'),
                'icon'      => $request->input('icon'),
                'sort'      => $request->input('sort'),
                'base'      => $request->input('base'),
                'active'    => $request->input('active')
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
     * Update the specified resource in storage.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   int     $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try
        {
            //dd($request->all());

            Lang::where('id', $id)->update([
                'id'        => $request->input('id'),
                'name'      => $request->input('name'),
                'icon'      => $request->input('icon'),
                'sort'      => $request->input('sort'),
                'base'      => $request->input('base'),
                'active'    => $request->input('active')
            ]);
        }
        catch (\Exception $e)
        {
            $response['status'] = "error";
            $response['message'] = $e->getMessage();

            return response()->json($response, 500);
        }

        $lang = Lang::find($request->input('id'));

        $response['status'] = "success";
        $response['data']   = $lang;

        return response()->json($response);
    }
}