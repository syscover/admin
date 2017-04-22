<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Country;

class CountryController extends CoreController
{
    protected $model = Country::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $object = Country::create([
            'id'                    => $request->input('id'),
            'lang_id'               => $request->input('lang_id'),
            'name'                  => $request->input('name'),
            'sort'                  => $request->input('sort'),
            'prefix'                => $request->input('prefix'),
            'territorial_area_1'    => $request->input('territorial_area_1'),
            'territorial_area_2'    => $request->input('territorial_area_2'),
            'territorial_area_3'    => $request->input('territorial_area_3'),
            'data_lang'             => Country::addLangDataRecord($request->input('lang_id'), $request->input('id'))
        ]);

        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   int     $id
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id, $lang)
    {
        Country::where('id', $id)->where('lang_id', $lang)->update([
            'name'                  => $request->input('name'),
            'sort'                  => $request->input('sort', 0),
            'territorial_area_1'    => $request->input('territorial_area_1'),
            'territorial_area_2'    => $request->input('territorial_area_2'),
            'territorial_area_3'    => $request->input('territorial_area_3')
        ]);

        // common data
        Country::where('id', $id)->update([
            'prefix' => $request->input('prefix')
        ]);

        $object = Country::where('id', $id)->where('lang_id', $lang)->first();

        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }
}
