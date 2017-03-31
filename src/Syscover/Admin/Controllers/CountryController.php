<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Country;

class CountryController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index($lang = null)
    {
        $query = Country::builder();

        if($lang !== null)
            $query->where('country.lang_id', $lang);

        $countries = $query->get();

        $response['data'] = $countries;

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country = Country::create([
            'id'                    => $request->input('id'),
            'lang_id'               => $request->input('lang_id'),
            'name'                  => $request->input('name'),
            'sort'                  => $request->input('sort'),
            'prefix'                => $request->input('prefix'),
            'territorial_area_1'    => $request->input('territorial_area_1'),
            'territorial_area_2'    => $request->input('territorial_area_2'),
            'territorial_area_3'    => $request->input('territorial_area_3'),
            'data_lang'             => Country::addLangDataRecord($request->input('lang'), $request->input('id'))
        ]);

        $response['status'] = "success";
        $response['data']   = $country;

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param   int     $id
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function show($id, $lang)
    {
        $country = Country::builder()
            ->where('country.lang_id', $lang)
            ->where('country.id', $id)
            ->first();

        $response['data'] = $country;

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

        $country = Country::where($request->input('id'));

        $response['status'] = "success";
        $response['data']   = $country;

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   int     $id
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function destroy($id, $lang = null)
    {
        if($lang === null)
        {
            $countries = Country::builder()
                ->where('country.id', $id)
                ->get();

            Country::builder()
                ->where('country.id', $id)
                ->delete();

            $response['data'] = $countries;
        }
        else
        {
            $country = Country::builder()
                ->where('country.lang_id', $lang)
                ->where('country.id', $id)
                ->first();

            $country->delete();

            $response['data'] = $country;
        }


        $response['status'] = "success";


        return response()->json($response);
    }
}
