<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\TerritorialArea1;

class TerritorialArea1Controller extends CoreController
{
    protected $model = TerritorialArea1::class;

    /**
     * Display a listing of the resource.
     *
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index($lang = null)
    {
        $query = TerritorialArea1::builder();

        if($lang !== null)
            $query->where('country.lang_id', $lang);

        $territorialAreas1 = $query->get();

        $response['data'] = $territorialAreas1;

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param   string  $id
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function show($id, $lang)
    {
        $territorialAreas1 = TerritorialArea1::builder()
            ->where('country.lang_id', $lang)
            ->where('territorial_area_1.id', $id)
            ->first();

        $response['data'] = $territorialAreas1;

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
