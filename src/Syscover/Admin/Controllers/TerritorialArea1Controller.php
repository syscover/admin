<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\TerritorialArea1;

class TerritorialArea1Controller extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @param   string  $lang
     * @param   string  $country
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index($lang = null, $country = null)
    {
        $query = TerritorialArea1::builder();

        if($lang !== null)
            $query->where('country.lang_id', $lang);

        if($country !== null)
            $query->where('territorial_area_1.country_id', $country);

        $territorialAreas1 = $query->get();

        return response()->json($territorialAreas1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param   string  $id
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function show($id, $lang = null)
    {
        $query = TerritorialArea1::builder();

        if($lang !== null)
            $query->where('country.lang_id', $lang);

        $territorialAreas1 = $query->where('territorial_area_1.id', $id)->get();

        return response()->json($territorialAreas1);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   int     $id
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function edit($id, $lang)
    {
        //
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
        //
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
        //
    }
}
